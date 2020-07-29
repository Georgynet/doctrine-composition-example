<?php

declare(strict_types=1);

namespace Contact\Handler;

use Contact\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class CreateContactHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateContactHandler
    {
        return new CreateContactHandler(
            $container->get(ContactRepository::class),
            $container->get(EntityManager::class),
        );
    }
}