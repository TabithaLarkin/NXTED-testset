<?php

declare(strict_types=1);

namespace Nxted\Kadai2;

class SleepNode extends CalculationNode
{
    private WorkNode $worker;

    public function __construct(
        int $remainingLines,
        int $currPerHour,
        private readonly NodeFactory $nodeFactory
    ) {
        $currPerHour = min(($currPerHour > 0 ? $currPerHour : 0) + $nodeFactory->sleepRecovery, $nodeFactory->maxPerHour);;

        // Always create a worker as we can't end on a sleep.
        $this->worker = $nodeFactory->createWorkNode($remainingLines, $currPerHour);
    }

    /**
     * Traverses the tree to find the branch with the lowest value.
     */
    protected function traverseOptimisedHours(): int
    {
        return $this->worker->getOptimisedHours() + $this->nodeFactory->sleepLength;
    }
}
