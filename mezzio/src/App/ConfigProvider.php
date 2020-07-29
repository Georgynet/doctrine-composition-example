<?php

declare(strict_types=1);

namespace App;

use App\Handler\HomePageHandler;
use App\Handler\PingHandler;
use Fig\Http\Message\RequestMethodInterface;

class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'routes' => $this->getRoutes(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    private function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories' => [
            ],
        ];
    }

    private function getRoutes(): array
    {
        return [
            [
                'path' => '/',
                'allowed_methods' => [RequestMethodInterface::METHOD_GET],
                'middleware' => [
                    HomePageHandler::class
                ],
            ],
            [
                'path' => '/api/ping',
                'allowed_methods' => [RequestMethodInterface::METHOD_GET],
                'middleware' => [
                    PingHandler::class
                ],
            ],
        ];
    }
}
