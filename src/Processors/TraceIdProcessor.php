<?php

namespace Arquivei\LogAdapter\Processors;

use Arquivei\LogAdapter\OpenCensusHelper;
use Monolog\Processor\ProcessorInterface;

class TraceIdProcessor implements ProcessorInterface
{
    private ?string $traceId = null;

    public function __invoke(array $records): array
    {
        $records['trace_id'] = $this->getTraceId();
        return $records;
    }

    private function getTraceId(): string
    {
        if ($this->traceId !== null) {
            return $this->traceId;
        }

        $this->traceId = OpenCensusHelper::traceId();
        return $this->traceId;
    }

    public function setTraceId(?string $traceId): void
    {
        $this->traceId = $traceId;
    }
}
