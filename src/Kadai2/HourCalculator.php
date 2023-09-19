<?php

declare(strict_types=1);

namespace Kadai2;

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
        return $this->calculateInternal($this->totalLines, $this->maxPerHour, 0);
    }

    private function calculateInternal(int $currLines, int $currPerHour, int $currentHoursSpent): int
    {
        $unproductiveHoursRemaining = ceil($currPerHour / $this->reduction);
        echo "unprodHrs {$unproductiveHoursRemaining}\n";

        $unproductiveCoding = 0;
        $currUnproductive = $currPerHour;
        for ($i = 0; $i < $unproductiveHoursRemaining; $i++) {
            $unproductiveCoding += $currUnproductive;
            $currUnproductive -= $this->reduction;
        }
        echo "unprodCoding {$unproductiveCoding}\n";

        if ($currLines <= $unproductiveCoding) {
            $n = 0;
            while ($currLines > 0 && $n < 10) {
                $currLines = $this->reduceLines($currLines, $currPerHour, $currentHoursSpent);
                $n++;
            }

            return $currentHoursSpent;
        }

        // If sleep is needed, then recover.
        if ($currPerHour <= ($this->maxPerHour - ($this->sleepRecovery / 2))) {
            $currPerHour = $this->recover($currPerHour, $this->sleepRecovery, $this->maxPerHour);
            // Sleep for 3 hours
            $currentHoursSpent += 3;
        } else {
            $currLines = $this->reduceLines($currLines, $currPerHour, $currentHoursSpent);
        }

        // If we've reached the end case exit recursion.
        if ($currLines <= 0) {
            return $currentHoursSpent;
        }

        // Otherwise continue with the calculation
        return $this->calculateInternal($currLines, $currPerHour, $currentHoursSpent);
    }

    private function recover(int $currPerHour): int
    {
        echo "slp\nslp\nslp\n";
        return min($currPerHour + $this->sleepRecovery, $this->maxPerHour);
    }

    private function reduceLines(int $currLines, int &$currPerHour, int &$currentHoursSpent)
    {
        $currLines -= $currPerHour;
        echo "wrote {$currPerHour}\n";
        echo "current: {$currLines}\n";
        $currPerHour -= $this->reduction;
        $currentHoursSpent++;

        return $currLines;
    }
}
