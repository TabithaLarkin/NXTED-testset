<?php

declare(strict_types=1);

namespace Nxted\Kadai2;

abstract class CalculationNode
{
    private int | null $cachedOptimisedValue = null;

    public function getOptimisedHours(): int
    {
        if ($this->cachedOptimisedValue === null) {
            $this->cachedOptimisedValue = $this->traverseOptimisedHours();
        }

        return $this->cachedOptimisedValue;
    }

    protected abstract function traverseOptimisedHours(): int;
}
