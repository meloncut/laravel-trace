<?php
/**
 * Created by PhpStorm.
 * User: dizzylee
 * Date: 2019/11/26
 * Time: 10:51 AM
 */

namespace Meloncut\Trace;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class TraceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('meloncut-trace',function ()  {
            $config = Config::get('trace');

            if (!isset($config['endpoint'])) return null;

            return new Trace(
                $config['endpoint'],
                $config['port'] ?? null,
                $config['ipv4'] ?? null,
                $config['ipv6'] ?? null
                );
        });
    }
}