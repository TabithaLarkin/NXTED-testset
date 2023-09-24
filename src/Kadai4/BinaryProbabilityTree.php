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
    private LeafNode $terminationNode;

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

    public function getRepeatsAllowed(): int
    {
        return $this->repeatsAllowed;
    }

    private function addChoiceLevel(BinaryChoiceNode $node): BinaryChoiceNode
    {
        $choiceNode = new BinaryChoiceNode();
        $node->setChildNodes($choiceNode, $this->nextTreeNode);
        return $choiceNode;
    }

    private function addTerminationLevel(BinaryChoiceNode $node): void
    {
        $this->terminationNode = new LeafNode();
        $node->setChildNodes($this->terminationNode, $this->nextTreeNode);
    }

    private function cacheKey(int $currDepth, int $maxDepth): string
    {
        return "{$currDepth}:{$maxDepth}";
    }

    /**
     * Calculates the negative outcome.
     * 
     * More accurate to sum the larger float numbers, rather than the smaller positive outcomes that can float round to zero.
     */
    public function getNegativeOutcomeProbability(int $currDepth, int $maxDepth): float
    {
        $cacheKey = $this->cacheKey($currDepth, $maxDepth);
        $depthProbability = $this->probabilityCache->get($cacheKey, null);

        if ($depthProbability !== null)
            return $depthProbability;

        // Slight optimisation to solve for the end of a tree where the probability is calculable
        if ($currDepth + $this->repeatsAllowed === $maxDepth)
            $depthProbability = $this->terminationNode->getFailureProbability($maxDepth, $maxDepth);
        else
            $depthProbability = $this->rootNode->getFailureProbability($currDepth, $maxDepth);

        $this->probabilityCache->put($cacheKey, $depthProbability);

        return $depthProbability;
    }
}
