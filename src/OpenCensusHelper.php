<?php

namespace Arquivei\LogAdapter;

use Ramsey\Uuid\Uuid;

class OpenCensusHelper
{
    /**
     * Generates a unique 16 byte sequence
     *
     * @link https://opencensus.io/tracing/#trace
     *
     * @return string Open Census TranceID
     */
    public static function traceId(): string
    {
        return str_replace('-', '', Uuid::uuid4());
    }
}
