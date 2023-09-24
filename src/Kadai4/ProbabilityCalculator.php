<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

use InvalidArgumentException;

class ProbabilityCalculator
{
    private BinaryProbabilityTree $tree;

    public function __construct(private int $length, int $repeatLimit)
    {
        if ($length > 10 ** 9 || $length < 1)
            throw new InvalidArgumentException("回連続の数が 1 から 1000000000 までではありません。");

        if ($repeatLimit > $length)
            throw new InvalidArgumentException("乱数列の長さは回連続の数以下でははいりません。");

        $this->tree = new BinaryProbabilityTree($repeatLimit - 1);
    }

    public function calculateProbability(): float
    {
        return $this->tree->getPositiveOutcomeProbability(1, 1, $this->length);
    }
}
