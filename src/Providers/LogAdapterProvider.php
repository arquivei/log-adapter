<?php

namespace Arquivei\LogAdapter\Providers;

use Arquivei\LogAdapter\Log;
use Arquivei\LogAdapter\Middleware\SetLoggerTraceId;
use Arquivei\LogAdapter\LogAdapter;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class LogAdapterProvider extends ServiceProvider
{
    public function boot()
    {

        if (env('BOOT_SET_LOGGER_TRACE_ID_MIDDLEWARE', true)) {
            $kernel = $this->app->make(Kernel::class);
            $kernel->pushMiddleware(SetLoggerTraceId::class);
        }
    }

    public function register()
    {
        $this->app->singleton(Log::class, LogAdapter::class);
    }
}
