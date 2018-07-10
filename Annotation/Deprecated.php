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
     * @var \DateTime|null
     */
    private $until = null;

    /**
     * @var bool
     */
    private $hideInDoc = false;

    /**
     * @param null|array $options
     * @throws AnnotationException
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            $this->until = isset($options['until']) ? new \DateTime($options['until']) : null;
            $this->hideInDoc = $options['hideInDoc'] ?? false;
        }
    }

    /**
     * @return \DateTime|null
     */
    public function getUntil(): ?\DateTime
    {
        return $this->until;
    }

    public function isHiddenInDoc(): bool
    {
        return $this->hideInDoc;
    }
}