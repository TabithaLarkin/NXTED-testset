<?php

declare(strict_types=1);

namespace Nxted;

use InvalidArgumentException;

class InputHelper
{
    public static function checkNumericInput(array $input): void
    {
        for ($i = 1; $i < count($input); $i++) {
            if (!is_numeric($input[$i])) {
                throw new InvalidArgumentException("入力「{$input[$i]}」は数値ではありません。\n");
            }
        }
    }
}
