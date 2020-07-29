<?php

declare(strict_types=1);

namespace Contact\Repository;

use Common\Repository\AbstractRepository;
use Contact\Generator\UuidGenerator;
use Contact\Model\Contact;
use Contact\Request\ContactDataRequest;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\LazyCriteriaCollection;

class ContactRepository extends AbstractRepository
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em, Contact::class);
    }

    public function createContact(ContactDataRequest $contactCreateRequest): Contact
    {
        return new Contact(
            UuidGenerator::generate(),
            $contactCreateRequest->getName(),
            $contactCreateRequest->getNumber(),
            $contactCreateRequest->getType(),
        );
    }

    public function findById(int $contactId): ?Contact
    {
        return $this->getRepo()->find($contactId);
    }

    public function findAll(int $offset, int $limit, ?string $name): LazyCriteriaCollection
    {
        $criteria = Criteria::create()
            ->orderBy(['name' => Criteria::ASC])
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        if ($name) {
            $criteria->where(Criteria::expr()->startsWith('name', $name));
        }

        return $this->getRepo()->matching($criteria);
    }
}