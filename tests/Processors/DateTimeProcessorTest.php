<?php

namespace Arquivei\LogAdapter\Tests\Processors;

use Arquivei\LogAdapter\Processors\DateTimeProcessor;
use Orchestra\Testbench\TestCase;


class DateTimeProcessorTest extends TestCase
{

    public function testProcessor()
    {
        $dateTimeProcessor = new DateTimeProcessor();
        $dateTime = new \DateTime();
        $dateTime->setDate(2020, 8, 8);
        $dateTime->setTime(8, 8);
        $records = $dateTimeProcessor([ 'datetime' => $dateTime]);

        self::assertArrayHasKey('datetime', $records);
        self::assertSame('2020-08-08 08:08:00.000000', $records['datetime']);
    }

}
