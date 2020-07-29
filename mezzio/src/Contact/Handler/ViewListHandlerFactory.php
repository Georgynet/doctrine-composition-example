<?php

declare(strict_types=1);

namespace Contact\Handler;

use Contact\Repository\ContactRepository;
use Psr\Container\ContainerInterface;

class ViewListHandlerFactory
{
    public function __invoke(ContainerInterface $container): ViewListHandler
    {
        return new ViewListHandler($container->get(ContactRepository::class));
    }
}