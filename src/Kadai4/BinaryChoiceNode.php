<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

class BinaryChoiceNode extends ProbabilityTreeNode
{
    private ProbabilityTreeNode $leftChild;
    private ProbabilityTreeNode $rightChild;

    public function setChildNodes(ProbabilityTreeNode $leftChild, ProbabilityTreeNode $rightChild): void
    {
        $this->leftChild = $leftChild;
        $this->rightChild = $rightChild;
    }


    public function getFailureProbability(int $currDepth, int $maxDepth): float
    {
        // Escape if the float value is equivalent to zero and return zero, or if the max depth has been reached.
        if ($currDepth === $maxDepth)
            return 0;

        // Update values for next layer
        $currDepth += 1;

        // Calculate probabilities for children.
        $leftProb = $this->leftChild->getFailureProbability($currDepth, $maxDepth);
        $rightProb = $this->rightChild->getFailureProbability($currDepth, $maxDepth);

        return $leftProb + $rightProb;
    }
}
