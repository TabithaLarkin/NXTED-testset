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


    public function getSuccessProbability(float $currProbability, int $currDepth, int $maxDepth): float
    {
        if ($currDepth === $maxDepth)
            return $currProbability;

        // Update values for next layer
        $currProbability = $currProbability / 2;
        $currDepth += 1;

        // Calculate probabilities for children.
        $leftProb = $this->leftChild->getSuccessProbability($currProbability, $currDepth, $maxDepth);
        $rightProb = $this->rightChild->getSuccessProbability($currProbability, $currDepth, $maxDepth);

        return $leftProb + $rightProb;
    }
}
