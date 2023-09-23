<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

class ProbabilityCalculator
{
    private BinaryProbabilityTree $tree;

    public function __construct(private int $length, int $repeatLimit)
    {
        $this->tree = new BinaryProbabilityTree($repeatLimit - 1);
    }

    public function calclateProbability(): float
    {
        return $this->tree->getPositiveOutcomeProbability(1, 1, $this->length);
    }
}
