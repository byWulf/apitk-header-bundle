<?php

declare(strict_types=1);

namespace Shopping\ApiTKHeaderBundle\EventListener;

use Shopping\ApiTKHeaderBundle\Service\HeaderInformation;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

/**
 * Adds the added header values (through HeaderInformation) to the response (f.e. the x-api-rfc14-pagination-total header).
 */
class HeaderResponseListener
{
    public function __construct(
        private HeaderInformation $headerInformation
    ) {
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        foreach ($this->headerInformation->getAll() as $key => $value) {
            $event->getResponse()->headers->set('x-apitk-' . $key, $value);
        }
    }
}
