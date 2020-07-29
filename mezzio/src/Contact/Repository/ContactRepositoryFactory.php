<?php

declare(strict_types=1);

namespace Contact\Repository;

use Contact\Model\Contact;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ContactRepositoryFactory
{
    public function __invoke(ContainerInterface $container): ContactRepository
    {
        $em = $container->get(EntityManager::class);

        return new ContactRepository($em->getRepository(Contact::class));
    }
}