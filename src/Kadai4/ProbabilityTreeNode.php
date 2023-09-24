<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

abstract class ProbabilityTreeNode
{
    public abstract function getFailureProbability(int $currDepth, int $maxDepth): float;
}
