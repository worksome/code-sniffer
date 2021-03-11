# Worksome's custom sniffs
This package contains all of Worksome's custom sniffs and configuration.

```
composer require worksome/code-sniffer --dev
```

## Usage

# Custom sniffs
List all the custom sniffs created by Worksome.

## Laravel 
All custom sniffs specific to Laravel.

### Config filename kebab case
Checks if all config files are written in kebab case.

### Disallow env usage
Makes sure that you don't use `env` helper in your code, except for config files.

## Generic
All custom sniffs which are not specific to Laravel.

### Property dollar sign
Makes sure that you always have a dollar sign in your properties defined in phpdoc.
```php
/**
* @property string $name
 */
class User {}
```

This is mainly because phpstan requires this before it sees the property as valid.