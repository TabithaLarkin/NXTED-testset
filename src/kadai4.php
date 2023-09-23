<?php

namespace Nxted;

require "vendor/autoload.php";

use InvalidArgumentException;
use Nxted\Kadai4\ProbabilityCalculator;

function tryCalculate(): bool
{
    // TODO: Update messages

    echo "番号を二つ入力してください。\n";

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

        echo "{$calc->calclateProbability()}\n";
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
