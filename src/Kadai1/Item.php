<?php

declare(strict_types=1);

namespace Nxted\Kadai1;

use RuntimeException;

class Item
{
    private int | null $price = null;
    private array $relations = [];

    public function getPrice(): int | null
    {
        return $this->price;
    }

    public function updatePrice(int $newPrice, array $updateStack = []): void
    {
        if (in_array($this, $updateStack))
            throw new RuntimeException("Circular Reference Detected.");

        $this->price = $newPrice;
        array_push($updateStack, $this);

        foreach ($this->relations as $relation) {
            $relation->updatePrice($this->price, $updateStack);
        }
    }

    public function addRelation(ItemRelation $relation): void
    {
        array_push($this->relations, $relation);
    }
}
