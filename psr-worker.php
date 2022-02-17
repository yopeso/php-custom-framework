<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\RoadRunner\Http\PSR7Worker;
use Spiral\RoadRunner\Worker;

require_once "bootstrap.php";

$worker = Worker::create();
$psrFactory = new Psr17Factory();
$psr7 = new PSR7Worker($worker, $psrFactory, $psrFactory, $psrFactory);

while (true) {
    try {
        $request = $psr7->waitRequest();

        if (!($request instanceof ServerRequestInterface)) {
            break;
        }

        $response = $router->dispatch($request);
        $psr7->respond($response);
    } catch (\Throwable $ex) {
        $psr7->respond(new Response(
            500,
            [
                'content-type' => 'application/json'
            ],
            json_encode([
                'message' => $ex->getMessage(),
                'trace' => $ex->getTrace(),
            ])
        ));
    }
}
