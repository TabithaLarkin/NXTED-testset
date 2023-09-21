<?php

declare(strict_types=1);

namespace Nxted\Kadai1;

use Ds\Map;
use RuntimeException;
use InvalidArgumentException;

class ItemPricer
{

    private Map $itemMap;

    public function __construct(int $itemCount)
    {
        if ($itemCount > 1000  || $itemCount < 2)
            throw new InvalidArgumentException("アイテムの数が２から１０００までではありません。");

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

        $item->addRelation($related, $difference);
    }

    public function evaluatePrices(): bool
    {
        try {
            $root = $this->itemMap->first()->value;
            $maxVal = $root->calcHighestValueRelation();

            // Calculate all maximum relationship values
            foreach ($this->itemMap->values() as $item) {
                $currVal = $item->calcHighestValueRelation();
                if ($currVal > $maxVal) {
                    $root = $item;
                    $maxVal = $currVal;
                }
            }
            // Update the price of the highest value child
            $root->updatePrice($maxVal + 1);
        } catch (RuntimeException) {
            return false;
        }

        return true;
    }

    public function forEachItem(callable $fn): void
    {
        foreach ($this->itemMap->values() as $item) {
            $fn($item);
        }
    }
}
