<?php

declare(strict_types=1);

namespace Nxted\Kadai3;

class BestFitLine
{

    private ?Point $nextPoint = null;
    private float $deviation;

    public function __construct(int $start, int $end, array $points)
    {
        if ($start === $end) {
            $this->deviation = 0;
        } else {
            $xSum = 0;
            $ySum = 0;
            $xySum = 0;
            $xSqSum = 0;

            for ($i = $start; $i <= $end; $i++) {
                $x = $points[$i]->getX();
                $y = $points[$i]->getY();

                $xSum += $x;
                $ySum += $y;

                $xySum += ($x * $y);

                $xSqSum += $x ** 2;
            }

            // Calculate y = mx + b

            $n = ($end - $start) + 1;

            $m = (($n * $xySum) - ($xSum * $ySum)) / (($n * $xSqSum) - ($xSum ** 2));

            $b = ($ySum - ($m * $xSum)) / $n;

            // Calculate Deviation

            $totalDeviation = 0;

            for ($i = $start; $i <= $end; $i++) {
                $x = $points[$i]->getX();
                $y = $points[$i]->getY();

                $totalDeviation += ($y - ($m * $x + $b)) ** 2;
            }

            // Set total deviation for this line
            $this->deviation = $totalDeviation;
        }

        // If there is a point after this one, then add it as a reference
        if ($end < count($points) - 1)
            $this->nextPoint = $points[$end + 1];
    }

    public function getChainedDeviation(int $penaltyValue): float
    {
        $nextDeviationValue = $this->nextPoint?->findMinimumErrorGroup($penaltyValue) ?? 0;
        return $penaltyValue + $this->deviation + $nextDeviationValue;
    }
}
