TsvReporter for PHP_CodeSniffer
===

# About
This is a reporter that exports TSV file.

# Usage

It is an example.

## 1. Add dependency.
```
$ composer require --dev yu0819ki/phpcs-tsv-reporter
```

## 2. Execute phpcs
```
$ ./vendor/bin/phpcs --report=./vendor/yu0819ki/phpcs-tsv-reporter/reporter.php --standard=PSR12 ./src
```