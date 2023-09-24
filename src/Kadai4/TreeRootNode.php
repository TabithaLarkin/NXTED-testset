<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

class TreeRootNode extends ProbabilityTreeNode
{
    public function __construct(private BinaryProbabilityTree $tree)
    {
    }

    public function getFailureProbability(int $currDepth, int $maxDepth): float
    {
        return $this->tree->getNegativeOutcomeProbability($currDepth, $maxDepth);
    }
}
