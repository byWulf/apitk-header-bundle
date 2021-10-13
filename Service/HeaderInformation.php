<?php

declare(strict_types=1);

namespace Shopping\ApiTKHeaderBundle\Service;

/**
 * Class HeaderInformation.
 *
 * @package Shopping\ApiTKHeaderBundle\Service
 */
class HeaderInformation
{
    /**
     * @var string[]
     */
    private array $headerInformation = [];

    /**
     * Register a value, which will be written in the response headers (key will be prefixed with 'x-api-').
     *
     * @param string $key
     * @param mixed  $value
     */
    public function add(string $key, $value): void
    {
        $this->headerInformation[$key] = $value;
    }

    /**
     * Returns all currently registered header information for the response.
     *
     * @return mixed[]
     */
    public function getAll(): array
    {
        return $this->headerInformation;
    }
}
