<?php
/**
 * Created by PhpStorm.
 * User: dizzylee
 * Date: 2019/11/26
 * Time: 10:15 AM
 */
namespace Meloncut\Trace;

use Meloncut\Trace\Contracts\TraceInterface;
use Zipkin\Endpoint;
use Zipkin\Samplers\BinarySampler;
use Zipkin\TracingBuilder;

class Trace implements TraceInterface
{
    private $tracing;

    public function __construct($endpoint, $port = null, $ipv4 = null, $ipv6 = null)
    {
        $endpoint = Endpoint::create($endpoint, $ipv4, $ipv6, $port);

        $logger = new \Monolog\Logger('log');
        $logger->pushHandler(new \Monolog\Handler\ErrorLogHandler());
        $reporter = new \Zipkin\Reporters\Http(\Zipkin\Reporters\Http\CurlFactory::create());
        $sampler = BinarySampler::createAsAlwaysSample();
        $this->tracing = TracingBuilder::create()
            ->havingLocalEndpoint($endpoint)
            ->havingSampler($sampler)
            ->havingReporter($reporter)
            ->build();
    }

    /**
     * @param $sign
     * @return \Zipkin\Span
     * @author <meloncut@outlook.com>
     */
    public function start($sign)
    {
        $span = $this->tracing->getTracer()->newTrace();
        $span->setName('sign');
        return $span;
    }

    /**
     * @param $sign
     * @param \Zipkin\Span $span
     * @return \Zipkin\Span
     * @author <meloncut@outlook.com>
     */
    public function next($sign, \Zipkin\Span $span)
    {
        $span = $this->tracing->getTracer()->nextSpan($span->getContext());
        $span->setName($sign);
        return $span;
    }

    /**
     * @param \Zipkin\Span $span
     * @author <meloncut@outlook.com>
     */
    public function finish(\Zipkin\Span $span)
    {
        $span->finish(time());
    }

    /**
     * @param \Zipkin\Span $span
     * @param string $tag
     * @param string $context
     * @author <meloncut@outlook.com>
     */
    public function tag(\Zipkin\Span $span, $tag = 'tag', $context = 'content')
    {
        $span->tag($tag, $context);
    }
}