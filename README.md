# Create your own PHP Framework #

[Presentation](https://drive.google.com/file/d/1Q2ZrWSZbkRmLVGtwspbT9l1s1L_T23ZR/view?usp=sharing)

## Description ##

The goal of this presentation / workshop is to provide an insight into the importance of PSR components in PHP
as well as provide a practical introduction into using PSR components to create a basic framework.

This example puts together the following components:

* `spiral/roadrunner` - this provides a worker system execute by a Go process which uses PHP CLI to execute. Provides basic PSR-7 compatibility
* `league/route` - PSR-7 and PSR-15 compatible router, based on fastroute
* `php-di/php-di` - PSR-11 compatible Dependency Injection container
* `nyholm/psr7` - the most popular PSR-7 package that implements request/response creation

PHPDI was also used to exemplify autowiring concepts and boostrapping a lightweight API-like application.

Roadrunner provides HTTP request handling, effectively replacing the FPM/NGINX combo for faster execution in a single container.
