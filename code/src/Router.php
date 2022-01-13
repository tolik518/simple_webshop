<?php
namespace webShop;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteCollectorProxy;

class Router
{
    public function __construct(
        private AdminDashboardPage $adminDashboardPage,
        private FrontPage          $frontPage,
        private SessionManager     $sessionManager
    ){}

    public function setRoutes(\Slim\App $app): void
    {
        //testing middleware
        $app->group('/admin', function (RouteCollectorProxy $group) {
            $group->get('/date', function (Request $request, Response $response) {
                $response->getBody()->write(date('Y-m-d H:i:s'));
                return $response;
            });

            $group->get('/time', function (Request $request, Response $response) {
                $response->getBody()->write((string)time());
                return $response;
            });
        })->add(function (Request $request, RequestHandler $handler) use ($app) {
            $response = $handler->handle($request);
            $dateOrTime = (string) $response->getBody();

            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write('It is now ' . $dateOrTime . '. Enjoy!');

            return $response;
        });

        $app->get('/', function (Request $request, Response $response){
            $outputHtml = $this->frontPage->getProductsAll();
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('frontPage');


        $app->get('/admin', function (Request $request, Response $response){
            $outputHtml = $this->adminDashboardPage->getPage();
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('adminDashboard');
    }
}