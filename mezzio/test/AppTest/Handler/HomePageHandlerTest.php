<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\HomePageHandler;
use Laminas\Diactoros\Response\JsonResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class HomePageHandlerTest extends TestCase
{
    public function testReturnsJson(): void
    {
        $homePage = new HomePageHandler();
        $response = $homePage->handle(
            $this->createMock(ServerRequestInterface::class)
        );

        self::assertInstanceOf(JsonResponse::class, $response);
    }
}
