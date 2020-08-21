<?php

namespace Arquivei\LogAdapter\Tests\Processors;

use Arquivei\LogAdapter\Processors\TraceIdProcessor;
use Orchestra\Testbench\TestCase;

class TraceIdProcessorTest extends TestCase
{
    public function testGetANewTraceId()
    {
        $traceIdProcessor = new TraceIdProcessor();

        $records = $traceIdProcessor([]);

        self::assertArrayHasKey('trace_id', $records);
    }

    public function testPreserveTraceId()
    {
        $traceIdProcessor = new TraceIdProcessor();
        $traceIdProcessor->setTraceId('88d98bf175fe832b70149a9637fcbb3f');

        $records = $traceIdProcessor([]);

        self::assertArrayHasKey('trace_id', $records);
        self::assertSame('88d98bf175fe832b70149a9637fcbb3f', $records['trace_id']);
    }

}
