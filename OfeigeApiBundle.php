<?php

namespace Ofeige\ApiBundle;

use Ofeige\ApiBundle\DependencyInjection\OfeigeApiExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OfeigeApiBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new OfeigeApiExtension();
    }
}