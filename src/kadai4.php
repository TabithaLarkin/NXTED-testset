<?php

namespace Nxted;

require "vendor/autoload.php";

use InvalidArgumentException;
use Nxted\Kadai4\ProbabilityCalculator;

function tryCalculate(): bool
{
    echo "乱数列の長さと回連続の数を入力してください。\n";

    $input = explode(' ', trim(fgets(STDIN)));

    if (count($input) !== 2) {
        echo "入力は二つではありません。\n";

        return false;
    }

    try {
        InputHelper::checkNumericInput($input);
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
        return false;
    }

    try {
        $calc = new ProbabilityCalculator(...$input);

        echo "{$calc->calculateProbability()}\n";
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
