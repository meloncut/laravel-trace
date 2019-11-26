<?php
/**
 * Created by PhpStorm.
 * User: dizzylee
 * Date: 2019/11/26
 * Time: 9:50 AM
 */
namespace Meloncut\Trace\Contracts;

interface TraceInterface
{
    /**
     * start trace and return a span
     *
     * @param $sign
     * @return \Zipkin\Span
     * @author <meloncut@outlook.com>
     */
    public function start($sign);

    /**
     * trace next step for parent span
     *
     * @param $sign
     * @param \Zipkin\Span $span
     * @return \Zipkin\Span
     * @author <meloncut@outlook.com>
     */
    public function next($sign, \Zipkin\Span $span);

    /**
     * finish trace for this span
     *
     * @param \Zipkin\Span $span
     * @author <meloncut@outlook.com>
     */
    public function finish(\Zipkin\Span $span);


    /**
     * @param \Zipkin\Span $span
     * @param string $tag
     * @param string $context
     * @author <meloncut@outlook.com>
     */
    public function tag(\Zipkin\Span $span, $tag = '', $context = '');
}