<?php

declare(strict_types=1);

namespace Nxted\Kadai2;

class SleepNode
{
    private WorkNode $worker;

    public function __construct(
        int $remainingLines,
        int $maxPerHour,
        int $currPerHour,
        int $reduction,
        int $sleepRecovery,
        private readonly int $sleepLength
    ) {
        $currPerHour = min(($currPerHour > 0 ? $currPerHour : 0) + $sleepRecovery, $maxPerHour);;

        // Always create a worker as we can't end on a sleep.
        $this->worker = new WorkNode(
            $remainingLines,
            $maxPerHour,
            $currPerHour,
            $reduction,
            $sleepRecovery,
            $sleepLength
        );
    }

    /**
     * Traverses the tree to find the branch with the lowest value.
     */
    public function getOptimisedHours()
    {
        return $this->worker->getOptimisedHours() + $this->sleepLength;
    }
}
