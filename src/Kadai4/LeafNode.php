<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

class LeafNode extends ProbabilityTreeNode
{
    public function getSuccessProbability(float $currProbability, int $currDepth, int $maxDepth): float
    {
        // There is no "good" outcome from this node, return 0.
        return 0;
    }
}
