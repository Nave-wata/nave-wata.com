<?php

use App\Infrastructure\Services\TwigCategoryExtension;
use DI\Bridge\Slim\Bridge;
use DI\Container;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Load settings
$settings = require __DIR__ . '/../app/settings.php';

// Create container
$containerBuilder = require __DIR__ . '/../app/container.php';
$container = $containerBuilder();

// Create app
$app = Bridge::create($container);

// Register Twig View
$container->set(Twig::class, function (Container $container) use ($settings) {
    $twig = Twig::create($settings['twig']['templates_path'], [
        'cache' => $settings['twig']['cache_path'],
        'debug' => $settings['twig']['debug'],
    ]);

    return $twig;
});

// Add Twig middleware
$app->add(TwigMiddleware::createFromContainer($app, Twig::class));

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

// Return app
return $app;
