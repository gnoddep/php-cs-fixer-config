<?php
declare(strict_types=1);

namespace Nerdman\CodeStyle\Config;

use Nerdman\CodeStyle\Config\Base\Config;

final class Php84 extends Config
{
    public static function getMinimalPhpVersionId(): int
    {
        return 80400;
    }

    protected function getAdditionalSets(): array
    {
        return ['@PHP84Migration'];
    }
}
