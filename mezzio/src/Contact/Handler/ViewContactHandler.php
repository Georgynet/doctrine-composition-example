<?php

declare(strict_types=1);

namespace Contact\Handler;

use Contact\Middleware\ContactMiddleware;
use Contact\Model\Contact;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ViewContactHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Contact $contact */
        $contact = $request->getAttribute(ContactMiddleware::class);

        return new JsonResponse([
            'success' => true,
            'contact' => $contact,
        ]);
    }
}