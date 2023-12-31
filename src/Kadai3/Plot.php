<?php

declare(strict_types=1);

namespace Nxted\Kadai3;

use InvalidArgumentException;

class Plot
{
    private array $points = [];

    public function __construct(private int $penaltyValue)
    {
        if ($penaltyValue > 100000 || $penaltyValue < 0)
            throw new InvalidArgumentException("一番目のパラメータが 0 から 100000 までではありません。");
    }

    public function addPoint(int $x, int $y): void
    {
        array_push($this->points, new Point($x, $y));
    }

    private function calculateDeviations(): void
    {
        $pointCount = count($this->points);

        for ($i = 0; $i < $pointCount; $i++) {
            $point = $this->points[$i];
            for ($j = $i; $j < $pointCount; $j++) {
                // Create a new best fit line
                $line = new BestFitLine($i, $j, $this->points);
                // Add it to the starting point
                $point->addBestFitLine($line);
            }
        }
    }

    public function calculateLeastSquare(): float
    {
        $this->calculateDeviations();

        // Calculate minimum deviation error from the first point in the plot.
        return $this->points[0]->findMinimumErrorGroup($this->penaltyValue);
    }
}
