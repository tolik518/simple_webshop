<?php

namespace webShop;
use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;

/**
 * @covers \webShop\SessionManager
 * @uses \webShop\ProductOrder
 */
class SessionManagerTest extends TestCase
{
    public function testSessionManagerCanBeConstructed(): void
    {
        self::assertInstanceOf('\webShop\SessionManager', new SessionManager());
    }

    public function testSetAuthenticatedUser(): void
    {
        $sessionManager = new SessionManager();
        $productorder = ProductOrder::set(0, ["test", "test2"]);

        $sessionManager->addToCart($productorder);
        //TODO: test schreiben
        self::assertIsArray($sessionManager->getCart());
    }
}