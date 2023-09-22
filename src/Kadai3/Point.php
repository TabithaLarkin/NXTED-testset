<?php

declare(strict_types=1);

namespace Nxted\Kadai3;

class Point
{
    private array $lines = [];
    private ?float $minimumDeviationError = null;

    public function __construct(private int $x, private int $y)
    {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function addBestFitLine(BestFitLine $line): void
    {
        array_push($this->lines, $line);
    }

    public function findMinimumErrorGroup(int $penaltyValue): float
    {
        if ($this->minimumDeviationError === null) {
            foreach ($this->lines as $line) {
                $currDeviationError = $line->getChainedDeviation($penaltyValue);
                if ($this->minimumDeviationError === null || $currDeviationError < $this->minimumDeviationError) {
                    $this->minimumDeviationError = $currDeviationError;
                }
            }
        }

        return $this->minimumDeviationError;
    }
}
