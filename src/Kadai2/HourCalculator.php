<?php

declare(strict_types=1);

namespace Nxted\Kadai2;

use InvalidArgumentException;

class HourCalculator
{
    public function __construct(
        private readonly int $totalLines,
        private readonly int $maxPerHour,
        private readonly int $reduction,
        private readonly int $sleepRecovery,
        private readonly int $sleepLength = 3
    ) {
        if ($totalLines < 1 || $maxPerHour < 1 || $reduction < 1 || $sleepRecovery < 1 || $sleepLength < 1)
            throw new InvalidArgumentException("パラメータの全部は１以上である必要があります。");
        if ($totalLines > 1000  || $maxPerHour > 1000)
            throw new InvalidArgumentException("一番と二番目のパラメータともは１０００を超えてはなりません。");
        if ($reduction > $maxPerHour)
            throw new InvalidArgumentException("三番目のパラメータは二番目を超えてはなりません。");
        if ($sleepRecovery > $maxPerHour)
            throw new InvalidArgumentException("四番目のパラメータは二番目を超えてはなりません。");
    }

    public function calculate(): int
    {
        $factory = new NodeFactory($this->totalLines, $this->maxPerHour, $this->reduction, $this->sleepRecovery, $this->sleepLength);
        $parentNode = $factory->createWorkNode($this->totalLines, $this->maxPerHour);

        return $parentNode->getOptimisedHours();
    }
}
