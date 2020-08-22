<?php

namespace Arquivei\LogAdapter\Processors;

use Monolog\Processor\ProcessorInterface;

class DateTimeProcessor implements ProcessorInterface
{
    private string $format;

    public function __construct(string $format = 'Y-m-d H:i:s.u')
    {
        $this->format = $format;
    }

    public function __invoke(array $records): array
    {
        $records['datetime'] = $records['datetime']->format($this->format);
        return $records;
    }
}
