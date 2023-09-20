<?php

declare(strict_types=1);

namespace Nxted\Kadai1;

class ItemRelation
{

    public function __construct(private Item $item, private int $difference)
    {
    }

    public function updatePrice(int $newPrice, array $updateStack): void
    {
        $itemPrice = $this->item->getPrice();
        if ($this->item->getPrice() === null || $itemPrice - $newPrice < $this->difference) {
            $this->item->updatePrice($newPrice + $this->difference, $updateStack);
        }
    }
}
