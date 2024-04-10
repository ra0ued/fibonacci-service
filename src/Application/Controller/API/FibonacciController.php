<?php

namespace App\Application\Controller\API;

use App\Application\Service\FibonacciService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FibonacciController
{
    private FibonacciService $fibonacciService;

    public function __construct(FibonacciService $fibonacciService)
    {
        $this->fibonacciService = $fibonacciService;
    }

    public function fibonacci(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $from = $request->getQueryParams()['from'] ?? 0;
        $to = $request->getQueryParams()['to'] ?? 1;

        $result = $this->fibonacciService->getFibonacci((int)$from, (int)$to) ?? 'Invalid input numbers';

        $payload = json_encode([
            'success' => true,
            'result' => $result
        ]);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
