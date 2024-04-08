<?php

declare(strict_types=1);

use App\Application\Controller\API\FibonacciController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $html = '
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Simple Fibonacci Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/form.js"></script>
</head>
<body>
<div class="container">
    <h1>Fibonacci</h1>
    <div class="row g-3">
        <div class="col-auto">
            <label for="from" class="visually-hidden">From</label>
            <input type="text" class="form-control" id="from" placeholder="From" required>
        </div>
        <div class="col-auto">
            <label for="to" class="visually-hidden">To</label>
            <input type="text" class="form-control" id="to" placeholder="To" required>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3" onclick="calculate()">Calculate</button>
        </div>
    </div>
    <label for="result">Result: </label>
    <textarea id="result" class="form-control" hidden="hidden" disabled readonly></textarea>
</div>
</body>
</html>
';

        $response->getBody()->write($html);

        return $response;
    });

    $app->group('/api/v1', function (Group $group) {
        $group->get('/fibonacci', [FibonacciController::class, 'fibonacci']);
    });
};
