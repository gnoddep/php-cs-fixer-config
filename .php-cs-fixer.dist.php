<?php
declare(strict_types=1);

use Nerdman\CodeStyle\Config\Php81;
use PhpCsFixer\Finder;

return new Php81(
    Finder::create()
        ->in(__DIR__)
        ->append(['.php-cs-fixer.dist.php'])
        ->notContains('/@nolint/'),
    '.php-cs-fixer.cache',
);
