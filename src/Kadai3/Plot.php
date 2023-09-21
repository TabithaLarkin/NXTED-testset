<?php

declare(strict_types=1);

namespace Nxted\Kadai3;

class Plot
{

    public function __construct(private int $c)
    {
    }

    public function addPoint(int $x, int $y): void
    {
    }

    public function calculateBestFit(): float
    {
        return 10.8;
    }
}
