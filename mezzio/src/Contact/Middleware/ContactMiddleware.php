<?php

declare(strict_types=1);

namespace Contact\Middleware;

use Contact\Exception\ContactNotFoundException;
use Contact\Model\Contact;
use Contact\Repository\ContactRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ContactMiddleware implements MiddlewareInterface
{
    private ContactRepository $contactRepo;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    /**
     * @throws ContactNotFoundException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $userId = (int)$request->getAttribute('contactId');
        $contact = $this->contactRepo->findById($userId);

        if (!$contact instanceof Contact) {
            throw new ContactNotFoundException($userId);
        }

        return $handler->handle($request->withAttribute(self::class, $contact));
    }
}