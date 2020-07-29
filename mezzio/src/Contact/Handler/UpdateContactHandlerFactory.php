<?php

declare(strict_types=1);

namespace Contact\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class UpdateContactHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdateContactHandler
    {
        return new UpdateContactHandler($container->get(EntityManager::class));
    }
}