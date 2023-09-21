<?php

declare(strict_types=1);

namespace Nxted\Kadai2;

use Ds\Map;

class NodeFactory
{
    private readonly Map $sleepNodeCache;
    private readonly Map $workNodeCache;


    public function __construct(
        private readonly int $totalLines,
        public readonly int $maxPerHour,
        public readonly int $reduction,
        public readonly int $sleepRecovery,
        public readonly int $sleepLength
    ) {
        $this->sleepNodeCache = new Map();
        $this->workNodeCache = new Map();
    }

    private function addToSleepCache(string $key, SleepNode $node): void
    {
        $this->sleepNodeCache->put($key, $node);
    }

    private function addToWorkCache(string $key, WorkNode $node): void
    {
        $this->workNodeCache->put($key, $node);
    }

    private function getCachedSleepNode(string $key): ?SleepNode
    {
        return $this->sleepNodeCache->get($key, null);
    }

    private function getCachedWorkNode(string $key): ?WorkNode
    {
        return $this->workNodeCache->get($key, null);
    }

    private function generateKey(int $remainingLines, int $currPerHour): string
    {
        return "{$remainingLines}:{$currPerHour}";
    }

    public function createWorkNode(int $remainingLines, int $currPerHour): WorkNode
    {
        $key = $this->generateKey($remainingLines, $currPerHour);
        $node = $this->getCachedWorkNode($key);

        if ($node === null) {
            $node = new WorkNode($remainingLines, $currPerHour, $this);
            $this->addToWorkCache($key, $node);
        }

        return $node;
    }

    public function createSleepNode(int $remainingLines, int $currPerHour): SleepNode
    {
        $key = $this->generateKey($remainingLines, $currPerHour);
        $node = $this->getCachedSleepNode($key);

        if ($node === null) {
            $node = new SleepNode($remainingLines, $currPerHour, $this);
            $this->addToSleepCache($key, $node);
        }

        return $node;
    }
}
