<?php

use League\Route\Router;
use Psr\Container\ContainerInterface;

require_once "vendor/autoload.php";

/** @var ContainerInterface $container */
$container = require "config/container/container.php";

/** @var Router $router */
$router = require "config/router/routes.php";
