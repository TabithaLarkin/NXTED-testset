<?php

declare(strict_types=1);

namespace Tests;

use Nxted\Kadai4\ProbabilityCalculator;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

final class ProbabilityCalculatorTest extends TestCase
{
    // Provided Test cases

    public function testSample1(): void
    {
        $calc = new ProbabilityCalculator(2, 2);

        $this->assertEquals(0.5, $calc->calculateProbability());
    }

    public function testSample2(): void
    {
        $calc = new ProbabilityCalculator(5, 3);

        $this->assertEquals(0.5, $calc->calculateProbability());
    }

    public function testSample3(): void
    {
        $calc = new ProbabilityCalculator(10, 10);

        $this->assertEquals(0.998046875, $calc->calculateProbability());
    }

    // Validation Tests

    public function testLengthTopLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProbabilityCalculator((10 ** 9) + 1, 10);
    }

    public function testLengthLowLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProbabilityCalculator(0, 0);
    }

    public function testLengthLessThanRepeat(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProbabilityCalculator(1, 2);
    }
}
