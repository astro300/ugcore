<?php

namespace Facades\UGCore\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \UGCore\Facades\DataXSL
 */
class DataXSL extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'UGCore\Facades\DataXSL';
    }
}
