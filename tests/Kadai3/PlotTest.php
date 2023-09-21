<?php

declare(strict_types=1);

namespace Tests;

use Nxted\Kadai3\Plot;
use PHPUnit\Framework\TestCase;

final class PlotTest extends TestCase
{
    // Provided Test cases

    public function testSample1(): void
    {
        $plot = new Plot(10);

        for ($i = 1; $i < 6; $i++) {
            $plot->addPoint($i, $i);
        }

        $this->assertEquals(10.8, $plot->calculateBestFit());
    }
}
