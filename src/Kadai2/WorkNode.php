<?php

declare(strict_types=1);

namespace Nxted\Kadai2;


class WorkNode
{
    private SleepNode | null $sleeper;
    private WorkNode | null $worker;

    public function __construct(
        int $remainingLines,
        int $maxPerHour,
        int $currPerHour,
        int $reduction,
        int $sleepRecovery,
        int $sleepLength
    ) {
        $remainingLines -= $currPerHour;
        $currPerHour -= $reduction;

        $this->sleeper = null;
        $this->worker = null;

        // If there is still work to be done, continue with tree construction
        if ($remainingLines > 0) {
            $this->sleeper = new SleepNode(
                $remainingLines,
                $maxPerHour,
                $currPerHour,
                $reduction,
                $sleepRecovery,
                $sleepLength
            );
            if ($currPerHour > 0) {
                $this->worker = new WorkNode(
                    $remainingLines,
                    $maxPerHour,
                    $currPerHour,
                    $reduction,
                    $sleepRecovery,
                    $sleepLength
                );
            }
        }
    }

    /**
     * Traverses the tree to find the branch with the lowest value.
     */
    public function getOptimisedHours()
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
