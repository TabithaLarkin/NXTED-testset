<?php

declare(strict_types=1);

namespace Nxted\Kadai1;

use Ds\Map;
use InvalidArgumentException;

class ItemPricer
{

    private Map $itemMap;

    public function __construct(int $itemCount)
    {
        $this->itemMap = new Map();
        for ($i = 0; $i < $itemCount; $i++) {
            // 1 indexed ids
            $this->itemMap->put($i + 1, new Item());
        }
    }

    public function getItem(int $id): Item
    {
        $item = $this->itemMap->get($id, null);
        if ($item === null)
            throw new InvalidArgumentException("Item not found. {$id}");

        return $item;
    }

    public function addRelation(int $target, int $relation, int $difference): void
    {
        $item = $this->getItem($target);
        $related = $this->getItem($relation);

        $item->addRelation(new ItemRelation($related, $difference));
    }

    public function evaluatePrices(): void
    {
        foreach ($this->itemMap->values() as $item) {
            // If the item does not yet have a price set, then initialise to 1.
            // Relationships between other items will then update the prices of other items.
            if ($item->getPrice() === null) {
                $item->updatePrice(1);
            }
        }
    }
}
