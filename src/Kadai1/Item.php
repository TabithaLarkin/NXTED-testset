<?php

declare(strict_types=1);

namespace Nxted\Kadai1;

class Item
{
    private int | null $price = null;
    private array $relations = [];

    public function getPrice(): int | null
    {
        return $this->price;
    }

    public function updatePrice(int $newPrice): void
    {
        $this->price = $newPrice;

        foreach ($this->relations as $relation) {
            $relation->updatePrice($this->price);
        }
    }

    public function addRelation(ItemRelation $relation): void
    {
        array_push($this->relations, $relation);
    }
}
