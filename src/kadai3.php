<?php

namespace Nxted;

use InvalidArgumentException;
use Nxted\Kadai3\Plot;

require "vendor/autoload.php";

function tryInitialise()
{
    echo "番号を二つ入力してください。\n";

    $input = explode(' ', trim(fgets(STDIN)));

    if (count($input) !== 2) {
        echo "入力は二つではありません。";
        return null;
    }

    try {
        InputHelper::checkNumericInput($input);

        if ($input[0] < 1)
            throw new InvalidArgumentException("一番目のパラメータは１より大きくなければなりません。");

        return array('plot' => new Plot($input[1]), 'points' => $input[0]);
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }

    return null;
}

function tryAddPoint(Plot $plot): bool
{
    $input = explode(' ', trim(fgets(STDIN)));

    if (count($input) !== 2) {
        echo "入力は二つではありません。";
        return false;
    }

    try {
        InputHelper::checkNumericInput($input);
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
        return false;
    }

    try {
        $plot->addPoint(...$input);
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}

function calculateBestFit(): void
{
    $init = null;

    while ($init === null)
        $init = tryInitialise();

    $plot = $init['plot'];

    $points = $init['points'];

    for ($i = 0; $i < $points; $i++) {
        $added = false;
        while (!$added) {
            $idx = $i + 1;
            echo "次のルールを入力してください。[{$idx}/{$points}]\n"; // update message
            $added = tryAddPoint($plot);
        }
    }
}

calculateBestFit();

exit();
