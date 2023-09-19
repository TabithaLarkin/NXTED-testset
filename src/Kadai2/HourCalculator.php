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
        $factory = new NodeFactory($this->totalLines, $this->maxPerHour, $this->reduction, $this->sleepRecovery, $this->sleepLength);
        $parentNode = $factory->createWorkNode($this->totalLines, $this->maxPerHour);

        return $parentNode->getOptimisedHours();
    }
}
