<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use Nxted\Kadai1\ItemPricer;

final class ItemPricerTest extends TestCase
{
    public function testSimpleRelation(): void
    {
        $pricer = new ItemPricer(2);

        $pricer->addRelation(1, 2, 100);

        $pricer->evaluatePrices();

        $this->assertSame($pricer->getItem(1)->getPrice(), 1);

        $this->assertSame($pricer->getItem(2)->getPrice(), 101);
    }

    public function testAddInvalidRelation(): void
    {
        $pricer = new ItemPricer(2);

        $this->expectException(InvalidArgumentException::class);

        $pricer->addRelation(1, 3, 100);
    }

    public function testAddInvalidRelationTarget(): void
    {
        $pricer = new ItemPricer(2);

        $this->expectException(InvalidArgumentException::class);

        $pricer->addRelation(3, 2, 100);
    }
}
