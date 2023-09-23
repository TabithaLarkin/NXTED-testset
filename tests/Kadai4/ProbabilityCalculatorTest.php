<?php

declare(strict_types=1);

namespace Tests;

use Nxted\Kadai4\ProbabilityCalculator;
use PHPUnit\Framework\TestCase;

final class ProbabilityCalculatorTest extends TestCase
{
    // Provided Test cases

    public function testSample1(): void
    {
        $calc = new ProbabilityCalculator(2, 2);

        $this->assertEquals(0.5, $calc->calclateProbability());
    }

    public function testSample2(): void
    {
        $calc = new ProbabilityCalculator(5, 3);

        $this->assertEquals(0.5, $calc->calclateProbability());
    }

    public function testSample3(): void
    {
        $calc = new ProbabilityCalculator(10, 10);

        $this->assertEquals(0.998046875, $calc->calclateProbability());
    }
}
