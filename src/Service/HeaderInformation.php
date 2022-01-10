<?php

declare(strict_types=1);

namespace Shopping\ApiTKHeaderBundle\Service;

class HeaderInformation
{
    /**
     * @var string[]
     */
    private array $headerInformation = [];

    /**
     * Register a value, which will be written in the response headers (key will be prefixed with 'x-api-').
     */
    public function add(string $key, mixed $value): void
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
