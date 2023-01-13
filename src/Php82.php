<?php
declare(strict_types=1);

namespace Nerdman\CodeStyle\Config;

use Nerdman\CodeStyle\Config\Base\Config;

final class Php82 extends Config
{
    protected function getMinimalPhpVersionId(): int
    {
        return 80200;
    }

    protected function getAdditionalSets(): array
    {
        return ['@PHP82Migration'];
    }
}
