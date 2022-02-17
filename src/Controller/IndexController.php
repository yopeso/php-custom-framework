<?php

namespace App\Controller;

use App\Service\PrefixService;
use App\Service\StringProcess;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class IndexController
{
    public function __construct(
        private StringProcess $service,
        private PrefixService $another
    )
    {

    }
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(
            200,
            [],
            $this->another->addPrefix($this->service->processString('This is my index'))
        );
    }
}
