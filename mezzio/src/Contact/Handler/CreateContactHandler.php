<?php

declare(strict_types=1);

namespace Contact\Handler;

use Contact\Middleware\ContactDataRequestMiddleware;
use Contact\Repository\ContactRepository;
use Contact\Request\ContactDataRequest;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreateContactHandler implements RequestHandlerInterface
{
    private ContactRepository $contactRepos;

    private EntityManager $em;

    public function __construct(ContactRepository $contactRepos, EntityManager $em)
    {
        $this->contactRepos = $contactRepos;
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var ContactDataRequest $contactRequest */
        $contactRequest = $request->getAttribute(ContactDataRequestMiddleware::class);

        $contact = $this->contactRepos->createContact($contactRequest);
        $this->em->persist($contact);
        $this->em->flush();

        return new JsonResponse([
            'success' => true,
            'contact' => $contact,
        ]);
    }
}