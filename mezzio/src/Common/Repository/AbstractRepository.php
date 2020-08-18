<?php

declare(strict_types=1);

namespace Common\Repository;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class AbstractRepository implements Selectable
{
    private EntityManager $entityManager;

    private string $entityName;

    public function __construct(EntityManager $em, string $entityName)
    {
        $this->entityManager = $em;
        $this->entityName = $entityName;
    }

    public function matching(Criteria $criteria)
    {
        return $this->getRepo()->matching($criteria);
    }

    protected function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    protected function getRepo(): EntityRepository
    {
        return $this->entityManager->getRepository($this->entityName);
    }
}
