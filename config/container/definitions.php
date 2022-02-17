<?php

use App\Service\PrefixService;
use Psr\Container\ContainerInterface;

return [
    'prefix'    => ' * THIS IS MY PREFIX *',
    'suffix'    => ' * THIS IS MY SUFFIX *',
    PrefixService::class => function (ContainerInterface $c) {
        return new PrefixService($c->get('prefix'));
    },
    'App\*\*' => DI\autowire('App\*\*'),
];
