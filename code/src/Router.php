<?php
namespace webShop;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

class Router
{
    public function __construct(
        private FrontPage      $frontPage,
        private SessionManager $sessionManager
    ){}

    public function setRoutes(\Slim\App $app): void
    {
        $app->get('/', function (Request $request, Response $response){
            $outputHtml = $this->frontPage->getProductsAll();
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('frontPage');
    }
}