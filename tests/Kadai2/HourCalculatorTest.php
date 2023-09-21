<?php

declare(strict_types=1);

namespace Tests;

use Nxted\Kadai2\HourCalculator;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

final class HourCalculatorTest extends TestCase
{
    private function calculateInternal(
        int $totalLines,
        int $maxPerHour,
        int $reduction,
        int $sleepRecovery,
        int $expected
    ): void {
        $calc = new HourCalculator($totalLines, $maxPerHour, $reduction, $sleepRecovery);

        $this->assertSame($expected, $calc->calculate());
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

    public function testHuge(): void
    {
        $this->calculateInternal(1000, 10, 1, 10, 197);
    }

    // Input Validation

    private function validationTest(
        int $totalLines,
        int $maxPerHour,
        int $reduction,
        int $sleepRecovery
    ): void {
        $this->expectException(InvalidArgumentException::class);

        new HourCalculator($totalLines, $maxPerHour, $reduction, $sleepRecovery);
    }

    public function testValidationTotalLowerLimit(): void
    {
        $this->validationTest(0, 10, 1, 10);
    }

    public function testValidationMaxPerHourLowerLimit(): void
    {
        $this->validationTest(1000, 0, 1, 10);
    }

    public function testValidationReductionLowerLimit(): void
    {
        $this->validationTest(1000, 10, 0, 10);
    }

    public function testValidationRecoveryLowerLimit(): void
    {
        $this->validationTest(1000, 10, 10, 0);
    }

    public function testValidationTotalUpperLimit(): void
    {
        $this->validationTest(10000, 10, 1, 10);
    }

    public function testValidationMaxPerHourUpperLimit(): void
    {
        $this->validationTest(1000, 10000, 1, 10);
    }

    public function testValidationReductionUpperLimit(): void
    {
        $this->validationTest(1000, 10, 100, 10);
    }

    public function testValidationRecoveryUpperLimit(): void
    {
        $this->validationTest(1000, 10, 10, 100);
    }
}
