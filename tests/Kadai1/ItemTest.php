<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Nxted\Kadai1\Item;
use RuntimeException;

final class ItemTest extends TestCase
{
    public function testMaxValCalc(): void
    {
        $baseItem = new Item();

        $leaf1 = new Item();
        $leaf2 = new Item();

        $baseItem->addRelation($leaf1, 100);
        $baseItem->addRelation($leaf2, 200);

        $this->assertSame($baseItem->calcHighestValueRelation(), 200);
    }

    public function testMaxValCalcNested(): void
    {
        $baseItem = new Item();

        $leaf1 = new Item();
        $leaf2 = new Item();
        $leaf3 = new Item();

        $baseItem->addRelation($leaf1, 100);
        $baseItem->addRelation($leaf2, 200);
        // Nest item
        $leaf1->addRelation($leaf3, 200);

        $this->assertSame($baseItem->calcHighestValueRelation(), 300);
    }

    public function testMaxValCalcCircular(): void
    {
        $baseItem = new Item();

        $leaf1 = new Item();
        $leaf2 = new Item();

        $baseItem->addRelation($leaf1, 100);
        $leaf1->addRelation($leaf2, 200);
        $leaf2->addRelation($baseItem, 200);

        $this->expectException(RuntimeException::class);

        $baseItem->calcHighestValueRelation();
    }

    public function testUpdatePrice(): void
    {
        $baseItem = new Item();

        $leaf1 = new Item();

        $baseItem->addRelation($leaf1, 100);

        $baseItem->updatePrice(101);

        $this->assertSame($baseItem->getPrice(), 101);
        $this->assertSame($leaf1->getPrice(), 1);
    }
}
