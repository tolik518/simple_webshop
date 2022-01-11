<?php
namespace webShop;

class Application
{
    private Router $router;
    private $variablesWrapper;

    public function __construct(Router $router, VariablesWrapper $variablesWrapper)
    {
        $this->router = $router;
        $this->variablesWrapper = $variablesWrapper;
    }

    public function start(\Slim\App $app)
    {
        $app->addErrorMiddleware(true, true, true);
        $this->router->setRoutes($app);
    }
}