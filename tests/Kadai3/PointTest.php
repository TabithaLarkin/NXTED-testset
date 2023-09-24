<?php

declare(strict_types=1);

namespace Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Nxted\Kadai3\Point;

final class PointTest extends TestCase
{

    // Validation Tests

    public function testTopYLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Point(1, 200001);
    }

    public function testBottomYLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Point(1, -200001);
    }

    public function testTopXLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Point(200001, 1);
    }

    public function testBottomXLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Point(-200001, 1);
    }
}
