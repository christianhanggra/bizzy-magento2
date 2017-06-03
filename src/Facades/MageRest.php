<?php

namespace Christianhanggra\Bizzy\Magento2\Facades;

use Illuminate\Support\Facades\Facade;

class MageRest extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Christianhanggra\Bizzy\Magento2\MageRest';
    }
}
