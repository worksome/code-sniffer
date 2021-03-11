# Worksome's custom sniffs
This package contains all of Worksome's custom sniffs and configuration.

```
composer require worksome/code-sniffer --dev
```

## Usage
Create a `phpcs.xml` in the root of your project with content like the following
```xml
<?xml version="1.0" encoding="UTF-8"?>
<ruleset name="YourCompany">
    <description>YourCompany Coding Standard</description>

    <file>./app</file>
    <file>./tests</file>
    <file>./config</file>

    <arg name="colors"/>
    <arg name="parallel" value="75"/>

    <!-- Adds all of Worksome's coding style -->
    <rule ref="WorksomeSniff"/>
</ruleset>

```

Run phpcs for seeing if you have any errors
```
vendor/bin/phpcs
```
Or run phpcbf for automatically fixing the errors when possible
```
vendor/bin/phpcbf
```

We suggest adding the commands as scripts in your `composer.json` for easier execution.
```json
...
"scripts": {
    "phpcs": "vendor/bin/phpcs",
    "phpcbf": "vendor/bin/phpcbf"
}
...
```

This way you can now execute them via composer
```
$ composer phpcs
$ composer phpcbf
```


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