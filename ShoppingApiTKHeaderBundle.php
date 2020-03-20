<?php

namespace Shopping\ApiTKHeaderBundle;

use Shopping\ApiTKHeaderBundle\DependencyInjection\ShoppingApiTKHeaderExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ShoppingApiTKHeaderBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ShoppingApiTKHeaderExtension();
    }
}
