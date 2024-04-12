<?php

declare(strict_types=1);

namespace App\Application\Service;

use PHP\Math\BigInteger\BigInteger;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class FibonacciService
{
    private const int CHUNK_SIZE = 100;
    private const string SEPARATOR = ', ';
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

        $chunk = $this->calculateChunk($from, $to);

        $cacheKey = $chunk['start'] . '_' . $chunk['end'];

        $cachedChunks = $this->cache->get($cacheKey, function (ItemInterface $item) use ($chunk): string {
            $item->expiresAfter(3600);

            $fibonacciNumbers = $this->calculateFibonacci($chunk['start'], $chunk['end']);

            return implode(self::SEPARATOR, $fibonacciNumbers);
        });

        $chunkArray = explode(self::SEPARATOR, $cachedChunks);
        $rangedResult = array_slice($chunkArray, $from - $chunk['start'], ($to - $from) + 1);

        return implode(self::SEPARATOR, $rangedResult);
    }

    private function calculateFibonacci(int $from, int $to): array
    {
        $firstNumber = 0;
        $secondNumber = 1;
        $result = [$firstNumber, $secondNumber];

        for ($i = 2; $i <= $to; $i++) {
            $nextNumber = (new BigInteger($firstNumber))->add($secondNumber);
            $result[] = $nextNumber->toString();

            $firstNumber = $secondNumber;
            $secondNumber = $nextNumber;
        }

        return array_slice($result, $from, ($to - $from) + 1);
    }

    private function calculateChunk(int $from, int $to): array
    {
        return [
            'start' => (int)(ceil($from === 0 ? 1 : $from / self::CHUNK_SIZE) - 1) * self::CHUNK_SIZE,
            'end' => (int)(ceil($to / self::CHUNK_SIZE)) * self::CHUNK_SIZE
        ];
    }
}
