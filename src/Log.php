<?php

namespace Arquivei\LogAdapter;

use Psr\Log\LoggerInterface;
use stdClass;

interface Log extends LoggerInterface
{
    public function setContext(?stdClass $stdClass): void;

    public function setTraceId(?string $traceId): void;
}
