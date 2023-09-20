<?php

namespace Nxted;

require "vendor/autoload.php";

use InvalidArgumentException;
use Nxted\Kadai2\HourCalculator;

function tryCalculate(): bool
{
    echo "番号を四つ入力してください。\n";

    $input = explode(' ', trim(fgets(STDIN)));

    if (count($input) !== 4) {
        echo "入力は四つではありません。\n";

        return false;
    }

    try {
        InputHelper::checkNumericInput($input);
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
        return false;
    }

    try {
        $calc = new HourCalculator(...$input);

        echo "{$calc->calculate()}\n";
    } catch (InvalidArgumentException $e) {
        echo "{$e->getMessage()}\n";
        return false;
    }

    return true;
}

$success = false;

while (!$success)
    $success = tryCalculate();


exit();
