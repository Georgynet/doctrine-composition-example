<?php

declare(strict_types=1);

namespace Contact\Repository;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ContactRepositoryFactory
{
    public function __invoke(ContainerInterface $container): ContactRepository
    {
        return new ContactRepository(
            $container->get(EntityManager::class)
        );
    }
}