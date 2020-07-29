<?php

declare(strict_types=1);

namespace Contact\Handler;

use Contact\Middleware\ContactMiddleware;
use Contact\Model\Contact;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveContactHandler implements RequestHandlerInterface
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

        $contactId = $contact->getId();

        $this->em->remove($contact);
        $this->em->flush();

        return new JsonResponse([
            'success' => true,
            'contactId' => $contactId
        ]);
    }
}