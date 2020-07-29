<?php

declare(strict_types=1);

namespace Contact\Handler;

use Contact\Middleware\ContactDataRequestMiddleware;
use Contact\Middleware\ContactMiddleware;
use Contact\Model\Contact;
use Contact\Request\ContactDataRequest;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UpdateContactHandler implements RequestHandlerInterface
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Contact $contact */
        $contact = $request->getAttribute(ContactMiddleware::class);

        /** @var ContactDataRequest $contactRequest */
        $contactRequest = $request->getAttribute(ContactDataRequestMiddleware::class);

        $contact->setName($contactRequest->getName());
        $contact->setNumber($contactRequest->getNumber());
        $contact->setType($contactRequest->getType());

        $this->em->persist($contact);
        $this->em->flush();

        return new JsonResponse([
            'success' => true,
            'contact' => $contact,
        ]);
    }
}