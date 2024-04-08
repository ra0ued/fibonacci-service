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

    public function fibonacci(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if (!$this->isValid($request)) {
            $payload = json_encode([
                'success' => false,
                'error' => 'Invalid request'
            ]);

            $response->getBody()->write($payload);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        $from = $request->getQueryParams()['from'] ?? 0;
        $to = $request->getQueryParams()['to'] ?? 1;

        /** @var FibonacciService $fibonacciService */
        $result = $this->fibonacciService->getFibonacci($from, $to) ?? 'Invalid input numbers';

        $payload = json_encode([
            'success' => true,
            'result' => $result
        ]);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    private function isValid(ServerRequestInterface $request): bool
    {
        return true;
    }
}