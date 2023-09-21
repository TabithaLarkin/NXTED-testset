<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use Nxted\Kadai1\ItemPricer;

final class ItemPricerTest extends TestCase
{

    // Provided Test cases

    public function testSample1(): void
    {
        $pricer = new ItemPricer(4);

        $pricer->addRelation(2, 1, 100);
        $pricer->addRelation(3, 2, -200);
        $pricer->addRelation(4, 2, 400);
        $pricer->addRelation(4, 3, 300);

        $pricer->evaluatePrices();

        $this->assertSame(1, $pricer->getItem(1)->getPrice());

        $this->assertSame(101, $pricer->getItem(2)->getPrice());

        $this->assertSame(201, $pricer->getItem(3)->getPrice());

        $this->assertSame(501, $pricer->getItem(4)->getPrice());
    }

    public function testSample2(): void
    {
        $pricer = new ItemPricer(3);

        $pricer->addRelation(1, 2, 1);
        $pricer->addRelation(2, 3, 1);
        $pricer->addRelation(3, 1, 1);

        $this->assertFalse($pricer->evaluatePrices());
    }

    // Custom Test Cases

    public function testSimpleRelation(): void
    {
        $pricer = new ItemPricer(2);

        $pricer->addRelation(2, 1, 100);

        $pricer->evaluatePrices();

        $this->assertSame(1, $pricer->getItem(1)->getPrice());

        $this->assertSame(101, $pricer->getItem(2)->getPrice());
    }

    public function testSimpleLinkedRelation(): void
    {
        $pricer = new ItemPricer(4);

        $pricer->addRelation(2, 1, 100);
        $pricer->addRelation(3, 2, 100);
        $pricer->addRelation(4, 3, 100);

        $pricer->evaluatePrices();

        $this->assertSame(1, $pricer->getItem(1)->getPrice());

        $this->assertSame(101, $pricer->getItem(2)->getPrice());

        $this->assertSame(201, $pricer->getItem(3)->getPrice());

        $this->assertSame(301, $pricer->getItem(4)->getPrice());
    }

    public function testSimpleSpreadRelation(): void
    {
        $pricer = new ItemPricer(4);

        $pricer->addRelation(2, 1, 100);
        $pricer->addRelation(3, 1, 200);
        $pricer->addRelation(4, 1, 300);

        $pricer->evaluatePrices();

        $this->assertSame(1, $pricer->getItem(1)->getPrice());

        $this->assertSame(101, $pricer->getItem(2)->getPrice());

        $this->assertSame(201, $pricer->getItem(3)->getPrice());

        $this->assertSame(301, $pricer->getItem(4)->getPrice());
    }

    public function testSimpleGroupedRelation(): void
    {
        $pricer = new ItemPricer(4);

        $pricer->addRelation(2, 1, 100);
        $pricer->addRelation(4, 3, 200);
        $pricer->addRelation(4, 2, 300);

        $pricer->evaluatePrices();

        $this->assertSame(1, $pricer->getItem(1)->getPrice());

        $this->assertSame(101, $pricer->getItem(2)->getPrice());

        $this->assertSame(201, $pricer->getItem(3)->getPrice());

        $this->assertSame(401, $pricer->getItem(4)->getPrice());
    }

    // Validation Tests

    public function testAddInvalidRelation(): void
    {
        $pricer = new ItemPricer(2);

        $this->expectException(InvalidArgumentException::class);

        $pricer->addRelation(3, 1, 100);
    }

    public function testAddInvalidRelationTarget(): void
    {
        $pricer = new ItemPricer(2);

        $this->expectException(InvalidArgumentException::class);

        $pricer->addRelation(2, 3, 100);
    }

    public function testLimitItemCountTop(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ItemPricer(2000);
    }

    public function testLimitItemCountBottom(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ItemPricer(1);
    }
}
