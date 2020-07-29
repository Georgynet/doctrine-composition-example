<?php

declare(strict_types=1);

namespace Contact;

use Contact\Handler\CreateContactHandler;
use Contact\Handler\CreateContactHandlerFactory;
use Contact\Handler\RemoveContactHandler;
use Contact\Handler\RemoveContactHandlerFactory;
use Contact\Handler\UpdateContactHandler;
use Contact\Handler\UpdateContactHandlerFactory;
use Contact\Handler\ViewContactHandler;
use Contact\Handler\ViewListHandler;
use Contact\Handler\ViewListHandlerFactory;
use Contact\Middleware\ContactMiddleware;
use Contact\Middleware\ContactMiddlewareFactory;
use Contact\Middleware\ContactDataRequestMiddleware;
use Contact\Repository\ContactRepository;
use Contact\Repository\ContactRepositoryFactory;
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
            ],
            'factories' => [
                ContactRepository::class => ContactRepositoryFactory::class,
                ContactMiddleware::class => ContactMiddlewareFactory::class,
                ViewListHandler::class => ViewListHandlerFactory::class,
                CreateContactHandler::class => CreateContactHandlerFactory::class,
                UpdateContactHandler::class => UpdateContactHandlerFactory::class,
                RemoveContactHandler::class => RemoveContactHandlerFactory::class
            ],
        ];
    }

    private function getRoutes(): array
    {
        return [
            [
                'path' => '/contact/{offset:\d+}/{limit:\d+}',
                'allowed_methods' => [RequestMethodInterface::METHOD_GET],
                'middleware' => [
                    ViewListHandler::class,
                ],
            ],
            [
                'path' => '/contact',
                'allowed_methods' => [RequestMethodInterface::METHOD_POST],
                'middleware' => [
                    ContactDataRequestMiddleware::class,
                    CreateContactHandler::class,
                ],
            ],
            [
                'path' => '/contact/{contactId:\d+}',
                'allowed_methods' => [RequestMethodInterface::METHOD_PUT],
                'middleware' => [
                    ContactMiddleware::class,
                    ContactDataRequestMiddleware::class,
                    UpdateContactHandler::class,
                ],
            ],
            [
                'path' => '/contact/{contactId:\d+}',
                'allowed_methods' => [RequestMethodInterface::METHOD_GET],
                'middleware' => [
                    ContactMiddleware::class,
                    ViewContactHandler::class,
                ],
            ],
            [
                'path' => '/contact/{contactId:\d+}',
                'allowed_methods' => [RequestMethodInterface::METHOD_DELETE],
                'middleware' => [
                    ContactMiddleware::class,
                    RemoveContactHandler::class,
                ],
            ],
        ];
    }
}
