<?php

declare(strict_types=1);

namespace Tests;

use Nxted\Kadai4\Matrix;
use PHPUnit\Framework\TestCase;

final class MatrixTest extends TestCase
{
    // Test power functionality is correct

    public function testCreate(): void
    {
        $matrix = new Matrix(2);

        $power = $matrix->power(1);

        $matrix->print($power);

        $this->assertEquals([0.5, 0.5, 0], $power[0]);
        $this->assertEquals([0.5, 0, 0], $power[1]);
        $this->assertEquals([0, 0.5, 1], $power[2]);
    }

    public function testCreate3Size(): void
    {
        $matrix = new Matrix(3);

        $power = $matrix->power(1);

        $matrix->print($power);

        $this->assertEquals([0.5, 0.5, 0], $power[0]);
        $this->assertEquals([0.5, 0, 0], $power[1]);
        $this->assertEquals([0, 0.5, 1], $power[2]);
    }

    public function testCreate3SizePower3(): void
    {
        $matrix = new Matrix(3);

        $power = $matrix->power(4);

        $matrix->print($power);

        $this->assertEquals([0.5, 0.5, 0], $power[0]);
        $this->assertEquals([0.5, 0, 0], $power[1]);
        $this->assertEquals([0, 0.5, 1], $power[2]);
    }

    public function testPower2(): void
    {
        $matrix = new Matrix(2);

        $power = $matrix->power(2);

        $this->assertEquals([0.25, 0, 0], $power[0]);
        $this->assertEquals([0.5, 0.25, 0], $power[1]);
        $this->assertEquals([0.75, 0, 1], $power[2]);
    }

    public function testPower3(): void
    {
        $matrix = new Matrix(2);

        $power = $matrix->power(3);

        $this->assertEquals([0.125, 0, 0], $power[0]);
        $this->assertEquals([0.375, 0.125, 0], $power[1]);
        $this->assertEquals([0.875, 0, 1], $power[2]);
    }

    // Test Probability Calculation is correct


    public function testProbability3And4(): void
    {
        $matrix = new Matrix(3);

        $power = $matrix->power(4);

        $matrix->print($power);

        $this->assertEquals(0.125, $power[0][3]);
    }

    public function testProbability2And2(): void
    {
        $matrix = new Matrix(2);

        $power = $matrix->power(2);

        $matrix->print($power);

        $this->assertEquals(0.5, $power[2][0]);
    }

    public function testProbability3And5(): void
    {
        $matrix = new Matrix(3);

        $power = $matrix->power(5);

        $matrix->print($power);

        $this->assertEquals(0.5, $power[3][0]);
    }
}
