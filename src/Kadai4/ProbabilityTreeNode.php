<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

abstract class ProbabilityTreeNode
{
    public abstract function getSuccessProbability(float $currProbability, int $currDepth, int $maxDepth): float;
}
