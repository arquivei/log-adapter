<?php

namespace Arquivei\LogAdapter\Tests\Middleware;

use Arquivei\LogAdapter\LogAdapter;
use Arquivei\LogAdapter\Middleware\SetLoggerTraceId;
use Orchestra\Testbench\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLoggerTraceIdTest extends TestCase
{

    public function testMiddlewareWithNoHeader()
    {
        $logAdapter = \Mockery::mock(LogAdapter::class);
        $logAdapter->shouldReceive('setTraceId')->with(null);

        $middleware = new SetLoggerTraceId($logAdapter);

        $request = new Request();
        $next = function () { return new Response();};

        $response = $middleware->handle($request, $next);

        self::assertInstanceOf(Response::class, $response);
    }

    public function testMiddlewareWithTraceHeader()
    {
        $request = new Request([],[],[],[],[],['HTTP_x-traceid' => '88d98bf175fe832b70149a9637fcbb3f']);
        $next = function () { return new Response();};

        $logAdapter = \Mockery::mock(LogAdapter::class);
        $logAdapter->shouldReceive('setTraceId')->with('88d98bf175fe832b70149a9637fcbb3f');

        $middleware = new SetLoggerTraceId($logAdapter);

        $response = $middleware->handle($request, $next);

        self::assertInstanceOf(Response::class, $response);
    }

}
