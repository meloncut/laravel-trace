<?php
/**
 * Created by PhpStorm.
 * User: dizzylee
 * Date: 2019/11/26
 * Time: 11:23 AM
 */
namespace Meloncut\Trace\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Trace
 * @package Meloncut\Trace\Facades
 * @method static start($sign)
 * @method static next($sign, \Zipkin\Span $span)
 * @method static finish(\Zipkin\Span $span)
 * @method static tag(\Zipkin\Span $span, $tag = 'tag', $context = 'content')
 */
class Trace extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'meloncut-trace';
    }
}