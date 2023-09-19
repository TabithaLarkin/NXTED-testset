<?php

declare(strict_types=1);

namespace Nxted\Kadai2;

class HourCalculator
{

    public function __construct(
        private readonly int $totalLines,
        private readonly int $maxPerHour,
        private readonly int $reduction,
        private readonly int $sleepRecovery,
        private readonly int $sleepLength = 3
    ) {
    }

    public function calculate(): int
    {
        $parentNode = new WorkNode($this->totalLines, $this->maxPerHour, $this->maxPerHour, $this->reduction, $this->sleepRecovery, $this->sleepLength);

        return $parentNode->getOptimisedHours();
    }
}
