<?php
declare(strict_types=1);

namespace Nerdman\CodeStyle\Config;

use Nerdman\CodeStyle\Config\Base\Config;

final class Php86 extends Config
{
    public static function getMinimalPhpVersionId(): int
    {
        return 80600;
    }

    protected function getAdditionalSets(): array
    {
        return ['@PHP8x5Migration'];
    }
}
