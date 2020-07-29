<?php

declare(strict_types=1);

namespace Contact\Handler;

use Contact\Repository\ContactRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ViewListHandler implements RequestHandlerInterface
{
    private ContactRepository $contactRepo;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParamName = $request->getQueryParams()['name'] ?? null;

        $offset = (int)$request->getAttribute('offset');
        $limit = (int)$request->getAttribute('limit');

        $contactCollection = $this->contactRepo->findAll(
            $offset,
            $limit,
            $queryParamName);

        return new JsonResponse([
            'success' => true,
            'offset' => $offset,
            'limit' => $limit,
            'total' => $contactCollection->count(),
            'list' => $contactCollection->toArray(),
        ]);
    }
}