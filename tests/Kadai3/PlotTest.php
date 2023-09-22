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

        $plot->addPoint(1, 1);
        $plot->addPoint(2, 2);
        $plot->addPoint(3, 4);
        $plot->addPoint(4, 4);
        $plot->addPoint(5, 5);

        $this->assertEquals(10.8, $plot->calculateLeastSquare());
    }

    public function testSample2(): void
    {
        $plot = new Plot(0);

        $plot->addPoint(1, 1);
        $plot->addPoint(2, 2);
        $plot->addPoint(3, 4);
        $plot->addPoint(4, 4);
        $plot->addPoint(5, 5);

        $this->assertEquals(0, $plot->calculateLeastSquare());
    }

    public function testSample3(): void
    {
        $plot = new Plot(8);

        $plot->addPoint(-1, -2);
        $plot->addPoint(1, 2);
        $plot->addPoint(3, 6);
        $plot->addPoint(4, 13);
        $plot->addPoint(8, 13);
        $plot->addPoint(9, 13);
        $plot->addPoint(10, 14);
        $plot->addPoint(12, 6);
        $plot->addPoint(16, 3);
        $plot->addPoint(20, 0);
        $plot->addPoint(21, -1);

        $this->assertEquals("24.53558075", number_format($plot->calculateLeastSquare(), 8, '.', ''));
    }
}
