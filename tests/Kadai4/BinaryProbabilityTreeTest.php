<?php

declare(strict_types=1);

namespace Tests;

use InvalidArgumentException;
use Nxted\Kadai4\BinaryProbabilityTree;
use PHPUnit\Framework\TestCase;

final class BinaryProbabilityTreeTest extends TestCase
{

    public function testSimple(): void
    {
        $tree = new BinaryProbabilityTree(3);

        $this->assertEquals(0.875, $tree->getPositiveOutcomeProbability(1, 1, 4));
    }

    public function testLargeRepeatAllowed(): void
    {
        $tree = new BinaryProbabilityTree(100);

        $this->assertEquals(1, $tree->getPositiveOutcomeProbability(1, 1, 100));
    }

    // Validation Tests

    public function testRepeatTopLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $tree = new BinaryProbabilityTree(101);
    }

    public function testRepeatLowLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $tree = new BinaryProbabilityTree(0);
    }
}
