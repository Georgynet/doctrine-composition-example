<?php

declare(strict_types=1);

namespace App\Middleware;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $response = $handler->handle($request);
        } catch (Throwable $e) {
            $response = $this->handleThrowable($e, $request);
        }

        return $response;
    }

    private function handleThrowable(Throwable $e, ServerRequestInterface $request) : ResponseInterface
    {
        return new JsonResponse([
            'success' => false,
            'code' => $e->getCode(),
            'error' => $e->getMessage(),
        ]);
    }
}