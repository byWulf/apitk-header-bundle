<?php

namespace Shopping\ApiHelperBundle\EventListener;

use Shopping\ApiHelperBundle\Service\HeaderInformation;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Class HeaderResponseListener
 *
 * Adds the added header values (through HeaderInformation) to the response (f.e. the x-api-rfc14-pagination-total header).
 *
 * @package Shopping\ApiHelperBundle\EventListener
 */
class HeaderResponseListener
{
    /**
     * @var HeaderInformation
     */
    private $headerInformation;

    /**
     * PaginationResponseListener constructor.
     * @param HeaderInformation $headerInformation
     */
    public function __construct(HeaderInformation $headerInformation)
    {
        $this->headerInformation = $headerInformation;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        foreach ($this->headerInformation->getAll() as $key => $value) {
            $event->getResponse()->headers->set('x-api-' . $key, $value);
        }
    }
}