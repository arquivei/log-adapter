# Arquivei Log Adapter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/arquivei/log-adapter.svg?style=flat-square)](https://packagist.org/packages/arquivei/log-adapter)
[![Total Downloads](https://img.shields.io/packagist/dt/arquivei/log-adapter.svg?style=flat-square)](https://packagist.org/packages/arquivei/log-adapter)
![PHP Composer](https://github.com/arquivei/log-adapter/workflows/PHP%20Composer/badge.svg?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/arquivei/log-adapter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/arquivei/log-adapter/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/arquivei/log-adapter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/arquivei/log-adapter/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/arquivei/log-adapter/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

A Monolog wrapper as Laravel Package.

+ JSON Formatting
+ Monolog
+ Psr\Log\LoggerInterface support
+ Laravel Package Discovery support

### Laravel Support

+ **Log** interface provider
+ HTTP Middleware to get TraceId Header

## Installation

You can install the package via composer:

```bash
composer require arquivei/log-adapter
```

## Usage

``` php
$logger = new LogAdapter();
$logger->setTraceId('88d98bf175fe832b70149a9637fcbb3f');
$logger->info('Logging', [
    'user' => 123
]);
```

```text
{"message":"Logging","context":{"user":123},"level":200,"level_name":"INFO","channel":"arquivei_log_adapter","datetime":"2020-08-21 11:31:17.565757","extra":{"memory_peak_usage":"4 MB","memory_usage":"4 MB"},"trace_id":"88d98bf175fe832b70149a9637fcbb3f"}
```

### Testing

``` bash
composer tests
```

### Full quality checks

``` bash
composer check
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Local Development using Docker

```shell script
docker build -f development.Dockerfile -t arquivei/php:7.4-development .
```

### Security

If you discover any security related issues, please email andre.gomes@arquivei.com.br instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
