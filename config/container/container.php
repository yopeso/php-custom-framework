<?php

use DI\ContainerBuilder;

$container = new DI\Container();
$builder = new ContainerBuilder();

$builder->useAutowiring(true);
$builder->useAnnotations(true);

$builder->addDefinitions(__DIR__ . '/definitions.php');
$container = $builder->build();

return $container;
