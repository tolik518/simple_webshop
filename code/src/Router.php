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
        private CartPage           $cartPage,
        private FrontPage          $frontPage,
        private OrderedPage        $orderedPage,
        private ProductPage        $productPage,
        private SessionManager     $sessionManager
    ){}

    public function setRoutes(\Slim\App $app): void
    {
        $app->group('/admin', function (RouteCollectorProxy $group) {
            $group->get('/', function (Request $request, Response $response){
                $outputHtml = $this->adminDashboardPage->getPage();
                $response->getBody()->write($outputHtml);
                return $response;
            });

            $group->get('/login', function (Request $request, Response $response) {
                $response->getBody()->write("NOT IMPLEMENTED");
                return $response;
            });

            $group->get('/logout', function (Request $request, Response $response) {
                $response->getBody()->write("NOT IMPLEMENTED");
                return $response;
            });
            $group->group('/orders', function (RouteCollectorProxy $group) {
                $group->get('/all',
                    function (Request $request, Response $response) {
                        $response->getBody()->write("NOT IMPLEMENTED");
                        return $response;
                    });

                $group->get('/open',
                    function (Request $request, Response $response) {
                        $response->getBody()->write("NOT IMPLEMENTED");
                        return $response;
                    });

                $group->get('/inprogress',
                    function (Request $request, Response $response) {
                        $response->getBody()->write("NOT IMPLEMENTED");
                        return $response;
                    });
                $group->get('/closed',
                    function (Request $request, Response $response) {
                        $response->getBody()->write("NOT IMPLEMENTED");
                        return $response;
                    });
            });
            //testing middleware
        })->add(function (Request $request, RequestHandler $handler) use ($app) {
            $response = $handler->handle($request);
            $dateOrTime = (string) $response->getBody();

            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write('before' . $dateOrTime . '. after');

            return $response;
        });


        $app->get('/', function (Request $request, Response $response){
            $outputHtml = $this->frontPage->getProductsAll();
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('frontPage');

        $app->get('/product/{productid}', function (Request $request, Response $response, array $getArgs){
            $productid = $getArgs['productid'];
            $outputHtml = $this->productPage->getProductByID($productid);
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('showProduct');

        $app->post('/product/addtocart', function (Request $request, Response $response){
            $this->productPage->addItemToCart();
            return $response->withHeader('Location', '/cart');
        })->setName('addtocart');

        $app->get('/cart', function (Request $request, Response $response){
            $outputHtml = $this->cartPage->getCart();
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('showCart');

        $app->post('/cart/deleteitem/{itemhash}', function (Request $request, Response $response,  array $getArgs){
            $itemhash = $getArgs['itemhash'];
            $this->sessionManager->deleteItemFromCart($itemhash);
            return $response->withHeader('Location', '/cart');
        })->setName('deleteItemFromCart');

        $app->post('/cart/checkout', function (Request $request, Response $response){
            $this->orderedPage->processOrder();
            $this->sessionManager->deleteCart();
            return $response->withHeader('Location', '/cart/checkout');
        })->setName('checkout');

        $app->get('/cart/checkout', function (Request $request, Response $response){
            $outputHtml = $this->orderedPage->showPageAfterOrdered();
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('checkout');
    }
}