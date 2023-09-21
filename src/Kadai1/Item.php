<?php

declare(strict_types=1);

namespace Nxted\Kadai1;

use RuntimeException;

class Item
{
    private ?int $price = null;
    private array $childRelations = [];
    private array $parentRelations = [];
    private ?ItemRelation $highestValue = null;


    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function updatePrice(int $newPrice): void
    {
        $this->price = $newPrice;

        // Order relations by difference, ascending
        usort($this->childRelations, function (ItemRelation $r1, ItemRelation $r2) {
            $r1d = $r1->getDiff();
            $r2d = $r2->getDiff();
            if ($r1d === $r2d) {
                return 0;
            }
            return ($r1d < $r2d) ? -1 : 1;
        });

        foreach ($this->childRelations as $relation) {
            $relation->updateChildPrice($this->price);
        }

        $this->updateParentPrices();
    }

    public function updateParentPrices()
    {
        // If there is more than one parent that the price could be inherited from
        if (count($this->parentRelations) > 1) {
            foreach ($this->parentRelations as $relation) {
                $relation->updateParentPrice($this->price);
            }
        }
    }

    public function addRelation(Item $child, int $difference): void
    {
        array_push($this->childRelations, new ItemRelation($child, $this, $difference));
        // Remove cache
        $this->highestValue = null;
    }

    public function assignParentRelation(ItemRelation $parentRelation): void
    {
        array_push($this->parentRelations, $parentRelation);
    }

    public function calcHighestValueRelation(array $updateStack = []): int
    {
        if ($this->highestValue === null) {
            if (count($this->childRelations) === 0)
                return 0;

            if (in_array($this, $updateStack, true))
                throw new RuntimeException("Circular Reference Detected.");

            array_push($updateStack, $this);

            $highVal = $this->childRelations[0]->findMaxValRelationship($updateStack);

            for ($i = 1; $i < count($this->childRelations); $i++) {
                $relVal = $this->childRelations[$i]->findMaxValRelationship($updateStack);
                if ($relVal > $highVal) {
                    $this->highestValue = $this->childRelations[$i];
                    $highVal = $relVal;
                }
            }

            return $highVal;
        }

        return $this->highestValue->findMaxValRelationship($updateStack);
    }
}
