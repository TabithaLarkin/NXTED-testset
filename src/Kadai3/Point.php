<?php

declare(strict_types=1);

namespace Nxted\Kadai3;

use InvalidArgumentException;

class Point
{
    private array $lines = [];
    private ?float $minimumDeviationError = null;

    public function __construct(private int $x, private int $y)
    {
        $this->validatePointRange($x);
        $this->validatePointRange($y);
    }

    private function validatePointRange(int $point): void
    {
        if ($point > 200000 || $point < -200000)
            throw new InvalidArgumentException("この点が-200000から200000までではありません。");
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
