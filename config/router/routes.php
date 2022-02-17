<?php

use App\Controller\IndexController;
use App\Service\PrefixService;
use App\Service\StringProcess;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Nyholm\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** @var ContainerInterface $container */

$router = new Router();

$strategy = new ApplicationStrategy();
$strategy->setContainer($container);
$router->setStrategy($strategy);

$router->map('GET', '/whatever', function (ServerRequestInterface $request): ResponseInterface {
    return new Response(200, [], 'This is xthe whatever page');
});

$router->map('GET', '/headers', function (ServerRequestInterface $request) use ($container)  {
    /** @var StringProcess $service */
    $service = $container->get(StringProcess::class);

    return new Response(
        200, [
            'content-type' => 'application/json',
        ],
        json_encode([
            'headers' => $request->getHeaders(),
            'prefixed' => $service->processString('test'),
        ])
    );
});

$router->map('GET', '/index', [IndexController::class, 'index']);

return $router;
