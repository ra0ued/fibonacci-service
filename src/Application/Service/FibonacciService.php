<?php

declare(strict_types=1);

namespace App\Application\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class FibonacciService
{
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function getFibonacci(int $from = 0, int $to = 1): ?string
    {
        if ($from < 0 || $to <= 0 || $to <= $from) {
            return null;
        }

        $cacheKey = $from . '+' . $to;

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($from, $to): string {
            $item->expiresAfter(3600);

            return $this->calculateFibonacci($from, $to);
        });
    }

    private function calculateFibonacci(int $from, int $to): string
    {
        $firstNumber = 0;
        $secondNumber = 1;
        $result = [];

        while (true) {
            $nextNumber = $firstNumber + $secondNumber;

            if ($nextNumber >= $from) {
                $result[] = $nextNumber;
            }

            if ($nextNumber >= $to) {
                return implode(', ', $result);
            }

            $firstNumber = $secondNumber;
            $secondNumber = $nextNumber;
        }
    }
}