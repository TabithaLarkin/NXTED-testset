<?php

namespace Nxted;

require "vendor/autoload.php";

use Nxted\Kadai2\HourCalculator;

function tryCalculate()
{
    echo "番号を四つ入力してください。\n";

    $input = explode(' ', trim(fgets(STDIN)));

    if (count($input) !== 4) {
        echo "入力は四つではありません。";
        tryCalculate();
        return;
    }

    for ($i = 1; $i < count($input); $i++) {
        if (!is_numeric($input[$i])) {
            echo "入力「{$input[$i]}」は数値ではありません。";
            tryCalculate();
            return;
        }
    }

    $calc = new HourCalculator(...$input);

    echo "{$calc->calculate()}\n";
}

tryCalculate();

exit();
