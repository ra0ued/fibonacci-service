<?php

namespace Tests\Application\Service;

use App\Application\Service\FibonacciService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class FibonacciServiceTest extends TestCase
{
    public function testGetFibonacciSuccess()
    {
        $fibonacciService = new FibonacciService(new FilesystemAdapter());

        $this->assertIsString($fibonacciService->getFibonacci(0, 6));
        $this->assertEquals('0, 1, 1, 2, 3, 5, 8', $fibonacciService->getFibonacci(0, 6));
        $this->assertEquals('2, 3, 5, 8', $fibonacciService->getFibonacci(3, 6));
    }

    public function testGetFibonacciError()
    {
        $fibonacciService = new FibonacciService(new FilesystemAdapter());

        $this->assertNull($fibonacciService->getFibonacci(-88, 0));
        $this->assertEquals(null, $fibonacciService->getFibonacci(-88, 0));
        $this->assertEquals(null, $fibonacciService->getFibonacci(42, -9));
    }
}
