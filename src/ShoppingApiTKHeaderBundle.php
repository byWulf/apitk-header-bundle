<?php

declare(strict_types=1);

namespace Shopping\ApiTKHeaderBundle;

use Shopping\ApiTKHeaderBundle\DependencyInjection\ShoppingApiTKHeaderExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ShoppingApiTKHeaderBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new ShoppingApiTKHeaderExtension();
    }

    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}
