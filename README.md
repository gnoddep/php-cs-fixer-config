## Nerdman PHP-CS-Fixer configuration

```
composer require --dev nerdman/php-cs-fixer-config
```

Add the following in your PHP-CS-Config file

``` lang=php
use Nerdman\PhpCsFixerConfig\Php81;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)
    ->exclude('var')
    ->notContains('/@nolint/');

return new Php81($finder, '.php-cs.cache');
```
