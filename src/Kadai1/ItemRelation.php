<?php

declare(strict_types=1);

namespace Nxted\Kadai1;

use InvalidArgumentException;

class ItemRelation
{
    public function __construct(private Item $child, private Item $parent, private int $difference)
    {
        if ($difference > 1000 || $difference < -1000)
            throw new InvalidArgumentException("価格差が-1000から1000までではありません。");

        $child->assignParentRelation($this);
    }

    public function updateChildPrice(int $newPrice): void
    {
        $this->child->updatePrice($newPrice - $this->difference);
    }

    public function updateParentPrice()
    {
        // Only update if the parent is not yet set.
        if ($this->parent->getPrice() === null)
            $this->parent->updatePrice($this->child->getPrice() + $this->difference);
    }

    public function findMaxValRelationship(array $updateStack): int
    {
        // Items will handle caching. Just return value.
        return $this->child->calcHighestValueRelation($updateStack) + $this->difference;
    }

    public function getDiff(): int
    {
        return $this->difference;
    }
}
