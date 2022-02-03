<?php
namespace webShop;

class Application
{
    public function __construct(
        private Router $router
    ){}

    public function start(\Slim\App $app): void
    {
        $app->addErrorMiddleware(true, true, true);
        $this->router->setRoutes($app);
    }
}