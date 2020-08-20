<?php

namespace Arquivei\LogAdapter\Processors;

use Monolog\Processor\ProcessorInterface;
use stdClass;

class DynamicContextProcessor implements ProcessorInterface
{
    private ?array $map;
    private ?stdClass $stdClass;

    public function __construct(?array $map = [], ?stdClass $stdClass = null)
    {
        $this->map = $map;
        $this->stdClass = $stdClass;
    }

    public function __invoke(array $records): array
    {
        return self::extract($records, $this->map, $this->stdClass);
    }

    /**
     * @param stdClass|null $stdClass
     */
    public function setStdClass(?stdClass $stdClass): void
    {
        $this->stdClass = $stdClass;
    }

    private function extract(?array $records, ?array $map, ?stdClass $stdClass = null): array
    {
        foreach ($map as $value) {
            eval($value . ";");
        }

        return $records;
    }
}
