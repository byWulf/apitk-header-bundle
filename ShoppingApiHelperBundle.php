<?php

namespace Shopping\ApiHelperBundle;

use Shopping\ApiHelperBundle\DependencyInjection\ShoppingApiHelperExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ShoppingApiHelperBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ShoppingApiHelperExtension();
    }
}