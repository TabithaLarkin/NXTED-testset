<?php

declare(strict_types=1);

namespace Tests;

use Nxted\Kadai2\HourCalculator;
use PHPUnit\Framework\TestCase;

final class HourCalculatorTest extends TestCase
{
    private function calculateInternal(
        int $totalLines,
        int $maxPerHour,
        int $sleepRecovery,
        int $reduction,
        int $expected
    ): void {
        $calc = new HourCalculator($totalLines, $maxPerHour, $sleepRecovery, $reduction);

        $this->assertSame($calc->calculate(), $expected);
    }

    public function testProvidedCase1(): void
    {
        $this->calculateInternal(61, 30, 10, 30, 6);
    }

    public function testProvidedCase2(): void
    {
        $this->calculateInternal(61, 30, 10, 30, 6);
    }

    public function testProvidedCase3(): void
    {
        $this->calculateInternal(60, 30, 10, 30, 3);
    }

    // [ 10  9   8   7   6   5   4   3   2   1]
    // 55

    public function testSmallInputsExact(): void
    {
        $this->calculateInternal(55, 10, 1, 10, 10);
    }

    public function testSmallInputsPlusOne(): void
    {
        $this->calculateInternal(56, 10, 1, 10, 10);
    }

    public function testSmallInputsEdge(): void
    {
        $this->calculateInternal(61, 10, 1, 10, 10);
    }

    public function testFullInputsEdge(): void
    {
        $this->calculateInternal(30, 10, 10, 10, 9);
    }

    public function testHalfInputsEdge(): void
    {
        $this->calculateInternal(30, 10, 5, 10, 7);
    }

    public function testSmallRecoveryEdge(): void
    {
        $this->calculateInternal(55, 10, 1, 1, 10);
    }
}
