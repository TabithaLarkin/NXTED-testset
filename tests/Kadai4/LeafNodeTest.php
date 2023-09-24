<?php

declare(strict_types=1);

namespace Tests;

use Nxted\Kadai4\LeafNode;
use PHPUnit\Framework\TestCase;

final class LeafNodeTest extends TestCase
{
    public function testLevel2(): void
    {
        $leaf = new LeafNode();

        $this->assertEquals(0.5, $leaf->getFailureProbability(2, 2));
    }

    public function testLevel3(): void
    {
        $leaf = new LeafNode();

        $this->assertEquals(0.25, $leaf->getFailureProbability(3, 3));
    }
}
