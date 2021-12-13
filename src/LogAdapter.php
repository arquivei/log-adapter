<?php

namespace Arquivei\LogAdapter;

use Arquivei\LogAdapter\Processors\DynamicContextProcessor;
use Arquivei\LogAdapter\Processors\TraceIdProcessor;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use stdClass;

class LogAdapter implements Log
{
    private Logger $logger;
    private TraceIdProcessor $traceIdProcessor;
    private DynamicContextProcessor $dynamicContextProcessor;

    public function __construct()
    {
        $stream = env('LOGGER_STREAM', 'php://stdout');
        $loggerLevel = env('LOGGER_LEVEL', 200);
        $loggerName = env('LOGGER_NAME', 'arquivei_log_adapter');

        $this->traceIdProcessor = new TraceIdProcessor();
        $this->dynamicContextProcessor = new DynamicContextProcessor();

        $handler = new StreamHandler($stream, $loggerLevel);
        $handler->setFormatter(new JsonFormatter());
        $this->logger = new Logger($loggerName);
        $this->logger->pushHandler($handler);

        $this->logger->pushProcessor(new MemoryUsageProcessor())
            ->pushProcessor(new MemoryPeakUsageProcessor())
            ->pushProcessor($this->traceIdProcessor)
            ->pushProcessor($this->dynamicContextProcessor);
    }

    /**
     * @param stdClass|null $stdClass
     */
    public function setContext(?stdClass $stdClass): void
    {
        $this->dynamicContextProcessor->setStdClass($stdClass);
        $this->logger->reset();
    }

    /**
     * @param string|null $traceId
     */
    public function setTraceId(?string $traceId = null): void
    {
        $this->traceIdProcessor->setTraceId($traceId);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function emergency($message, array $context = []): void
    {
        $this->logger->emergency($message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function alert($message, array $context = []): void
    {
        $this->logger->alert($message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function critical($message, array $context = []): void
    {
        $this->logger->critical($message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function error($message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function warning($message, array $context = []): void
    {
        $this->logger->warning($message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function notice($message, array $context = []): void
    {
        $this->logger->notice($message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function info($message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function debug($message, array $context = []): void
    {
        $this->logger->debug($message, $context);
    }

    public function log($level, $message, array $context = array()): void
    {
        $this->logger->log($level, $message, $context);
    }
}
