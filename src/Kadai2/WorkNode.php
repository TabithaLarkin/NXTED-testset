<?php

declare(strict_types=1);

namespace Nxted\Kadai2;

class WorkNode extends CalculationNode
{
    private ?SleepNode $sleeper;
    private ?WorkNode $worker;

    public function __construct(
        int $remainingLines,
        int $currPerHour,
        NodeFactory $nodeFactory
    ) {
        $remainingLines -= $currPerHour;
        $currPerHour -= $nodeFactory->reduction;

        $this->sleeper = null;
        $this->worker = null;

        // If there is still work to be done, continue with tree construction
        if ($remainingLines > 0) {
            $this->sleeper = $nodeFactory->createSleepNode($remainingLines, $currPerHour);

            if ($currPerHour > 0) {
                $this->worker = $nodeFactory->createWorkNode($remainingLines, $currPerHour);
            }
        }
    }

    /**
     * Traverses the tree to find the branch with the lowest value.
     */
    protected function traverseOptimisedHours(): int
    {
        // Leaf node, return 1.
        if ($this->sleeper === null) {
            return 1;
        }

        // Sleeper is the only leaf
        if ($this->worker === null) {
            return $this->sleeper->getOptimisedHours() + 1;
        }

        // Return the smaller of the two branches.
        return min($this->worker->getOptimisedHours(), $this->sleeper->getOptimisedHours()) + 1;
    }
}
