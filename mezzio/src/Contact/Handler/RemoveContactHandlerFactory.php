<?php

declare(strict_types=1);

namespace Contact\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class RemoveContactHandlerFactory
{
    public function __invoke(ContainerInterface $container): RemoveContactHandler
    {
        return new RemoveContactHandler($container->get(EntityManager::class));
    }
}