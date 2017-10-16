<?php

namespace Facades\UGCore\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \UGCore\Facades\Messages
 */
class Messages extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'UGCore\Facades\Messages';
    }
}
