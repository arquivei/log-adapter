<?php

namespace Arquivei\LogAdapter\Tests\Processors;

use Arquivei\LogAdapter\Processors\DynamicContextProcessor;
use Orchestra\Testbench\TestCase;

class DynamicContextProcessorTest extends TestCase
{

    public function testStringEval()
    {
        $records = [];
        $map = [
            //'$records[\'context\'][\'number\'] = $stdClass->Context->Number',
            '$records[\'context\'][\'number\'] = $stdClass->Context[\'Number\']',
            '$records[\'context\'][\'text\'] = $stdClass->Context[\'Text\']',
            '$records[\'user\'] = $stdClass->User',
        ];
        $stdClass = (object) [
            'Context' => [
                'Number' => 1234567890,
                'Text' => 'TEXT'
            ],
            'User' => 123
        ];
        $dynamicContextProcessor = new DynamicContextProcessor($map, $stdClass);
        $expected = $dynamicContextProcessor($records);

        $this->assertSame($expected['context']['number'], 1234567890);
        $this->assertSame($expected['context']['text'], 'TEXT');
        $this->assertSame($expected['user'], 123);
    }

}
