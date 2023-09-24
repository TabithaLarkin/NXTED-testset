<?php

declare(strict_types=1);

namespace Nxted\Kadai4;

use Ds\Map;
use InvalidArgumentException;

class BinaryProbabilityTree
{
    private BinaryChoiceNode $rootNode;
    private TreeRootNode $nextTreeNode;
    private Map $probabilityCache;

    public function __construct(private int $repeatsAllowed)
    {
        if ($repeatsAllowed > 100 || $repeatsAllowed < 1)
            throw new InvalidArgumentException("回連続の数が 1 から 100 までではありません。");

        $this->probabilityCache = new Map();

        $this->rootNode = new BinaryChoiceNode();

        $this->nextTreeNode = new TreeRootNode($this);

        $currentNode = $this->rootNode;

        for ($i = 0; $i < $repeatsAllowed - 1; $i++) {
            $currentNode = $this->addChoiceLevel($currentNode);
        }

        $this->addTerminationLevel($currentNode);
    }

    private function addChoiceLevel(BinaryChoiceNode $node): BinaryChoiceNode
    {
        $choiceNode = new BinaryChoiceNode();
        $node->setChildNodes($choiceNode, $this->nextTreeNode);
        return $choiceNode;
    }

    private function addTerminationLevel(BinaryChoiceNode $node): void
    {
        $node->setChildNodes(new LeafNode(), $this->nextTreeNode);
    }

    private function cacheKey(float $currProbability, int $currDepth): string
    {
        return "{$currDepth}:{$currProbability}";
    }

    public function getPositiveOutcomeProbability(float $currProbability, int $currDepth, int $maxDepth): float
    {
        $cacheKey = $this->cacheKey($currProbability, $currDepth);
        $depthProbability = $this->probabilityCache->get($cacheKey, null);

        if ($depthProbability !== null)
            return $depthProbability;

        // Slight optimisation to solve for the end of a tree where the probability is calculable
        if ($currDepth + $this->repeatsAllowed === $maxDepth)
            $depthProbability = $currProbability * (1 - (1 / (2 ** $this->repeatsAllowed)));
        else
            $depthProbability = $this->rootNode->getSuccessProbability($currProbability, $currDepth, $maxDepth);

        $this->probabilityCache->put($cacheKey, $depthProbability);

        return $depthProbability;
    }
}
