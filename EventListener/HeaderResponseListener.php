<?php

namespace Shopping\ApiTKHeaderBundle\EventListener;

use Shopping\ApiTKHeaderBundle\Service\HeaderInformation;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

/**
 * Class HeaderResponseListener.
 *
 * Adds the added header values (through HeaderInformation) to the response (f.e. the x-api-rfc14-pagination-total header).
 *
 * @package Shopping\ApiTKHeaderBundle\EventListener
 */
class HeaderResponseListener
{
    private HeaderInformation $headerInformation;

    public function __construct(HeaderInformation $headerInformation)
    {
        $this->headerInformation = $headerInformation;
    }

    /**
     * @param ResponseEvent $event
     */
    public function onKernelResponse(ResponseEvent $event): void
    {
        foreach ($this->headerInformation->getAll() as $key => $value) {
            $event->getResponse()->headers->set('x-apitk-' . $key, $value);
        }
    }
}
