<?php

namespace Ofeige\ApiBundle\Describer;

use Doctrine\Common\Annotations\Reader;
use EXSyst\Component\Swagger\Operation;
use EXSyst\Component\Swagger\Swagger;
use Nelmio\ApiDocBundle\Describer\DescriberInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\Util\ControllerReflector;
use Symfony\Component\Routing\RouteCollection;
use Ofeige\ApiBundle\Annotation AS Api;

/**
 * Class AnnotationDescriber
 *
 * Auto generate 200-responses by the annotated dtoMapper.
 *
 * The following conditions must match:
 * * No Response(200) annotation given
 * * Rfc1\View annotation with dtoMapper given
 * * Corresponding dtoMapper has a return typehint
 * * Controller action has a return-annotation, which states the return of an array or not (f.e. * @ return Foobar[])
 *
 * @package Ofeige\Rfc11Bundle\Describer
 */
class AnnotationDescriber implements DescriberInterface, ModelRegistryAwareInterface
{
    use ModelRegistryAwareTrait;

    /**
     * @var RouteCollection
     */
    private $routeCollection;
    /**
     * @var ControllerReflector
     */
    private $controllerReflector;
    /**
     * @var Reader
     */
    private $reader;

    //TODO: Replace ControllerReflector with something we can depend on
    /**
     * @param RouteCollection $routeCollection
     * @param ControllerReflector $controllerReflector
     * @param Reader $reader
     */
    public function __construct(
        RouteCollection $routeCollection,
        ControllerReflector $controllerReflector,
        Reader $reader
    ) {
        $this->routeCollection = $routeCollection;
        $this->controllerReflector = $controllerReflector;
        $this->reader = $reader;
    }

    /**
     * @param Swagger $api
     */
    public function describe(Swagger $api)
    {
        $paths = $api->getPaths();
        foreach ($paths as $uri => $path) {
            foreach ($path->getMethods() as $method) {
                /** @var Operation $operation */
                $operation = $path->getOperation($method);

                foreach ($this->getMethodsToParse() as $classMethod => list($methodPath, $httpMethods)) {
                    if ($methodPath === $uri && in_array($method, $httpMethods)) {
                        foreach ($this->reader->getMethodAnnotations($classMethod) as $annotation) {
                            if (!$annotation instanceof Api\Deprecated) {
                                continue;
                            }

                            /** @noinspection PhpToStringImplementationInspection */
                            $operation->setDescription('!!! DEPRECATED !!! ' . $operation->getSummary());
                        }
                    }
                }
            }
        }
    }

    /**
     * @return \Generator
     */
    private function getMethodsToParse(): \Generator
    {
        foreach ($this->routeCollection->all() as $route) {
            if (!$route->hasDefault('_controller')) {
                continue;
            }

            $controller = $route->getDefault('_controller');
            if ($callable = $this->controllerReflector->getReflectionClassAndMethod($controller)) {
                $path = $this->normalizePath($route->getPath());
                $httpMethods = $route->getMethods() ?: Swagger::$METHODS;
                $httpMethods = array_map('strtolower', $httpMethods);
                $supportedHttpMethods = array_intersect($httpMethods, Swagger::$METHODS);

                if (empty($supportedHttpMethods)) {
                    continue;
                }

                yield $callable[1] => [$path, $supportedHttpMethods];
            }
        }
    }

    /**
     * @param string $path
     * @return string
     */
    private function normalizePath(string $path): string
    {
        if ('.{_format}' === substr($path, -10)) {
            $path = substr($path, 0, -10);
        }

        return $path;
    }
}