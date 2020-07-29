<?php

declare(strict_types=1);

namespace Contact\Middleware;

use Contact\Repository\ContactRepository;
use Psr\Container\ContainerInterface;

class ContactMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ContactMiddleware
    {
        return new ContactMiddleware($container->get(ContactRepository::class));
    }
}