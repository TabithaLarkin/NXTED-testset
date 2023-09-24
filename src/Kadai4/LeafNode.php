<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

class LeafNode extends ProbabilityTreeNode
{
    public function getFailureProbability(int $currDepth, int $maxDepth): float
    {
        return 1 / (2 ** ($currDepth - 1));
    }
}
