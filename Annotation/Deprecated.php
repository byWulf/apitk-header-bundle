<?php
declare(strict_types=1);

namespace Ofeige\ApiBundle\Annotation;
use Doctrine\Common\Annotations\AnnotationException;

/**
 * Class Deprecated
 *
 * @package Ofeige\ApiBundle\Annotation
 * @Annotation
 */
class Deprecated
{
    /**
     * @var \DateTime
     */
    private $until;

    /**
     * @param null|array $options
     * @throws AnnotationException
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            if (!isset($options['until']) || !($date = new \DateTime($options['until']))) {
                throw new AnnotationException('Until option is missing or invalid. Use date format Y-m-d.');
            }

            $this->until = new \DateTime($date);
        }
    }

    /**
     * @return \DateTime
     */
    public function getUntil(): \DateTime
    {
        return $this->until;
    }
}