<?php

declare(strict_types=1);

namespace Contact\Middleware;

use Contact\Request\ContactDataRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ContactDataRequestMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $bodyContents = $request->getBody()->getContents();
        $json = json_decode($bodyContents);

        return $handler->handle(
            $request->withAttribute(
                static::class,
                new ContactDataRequest(
                    $json->name ?? null,
                    $json->number ?? null,
                    $json->type ?? null
                )
            )
        );
    }
}