<?php namespace Jormin\Geetest\Facades;

use Illuminate\Support\Facades\Facade;

class KDNiao extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kdniao';
    }
}