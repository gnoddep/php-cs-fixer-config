<?php
declare(strict_types=1);

use Nerdman\CodeStyle\Config\Php83;
use PhpCsFixer\Finder;

return new Php83(
    Finder::create()
        ->in(__DIR__)
        ->append(['.php-cs-fixer.dist.php'])
        ->notContains('/@nolint/'),
    '.php-cs-fixer.cache',
);
