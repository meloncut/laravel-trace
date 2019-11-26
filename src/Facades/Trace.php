<?php
/**
 * Created by PhpStorm.
 * User: dizzylee
 * Date: 2019/11/26
 * Time: 11:23 AM
 */
namespace Meloncut\Trace\Facades;

use Illuminate\Support\Facades\Facade;

class Trace extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'meloncut-trace';
    }
}