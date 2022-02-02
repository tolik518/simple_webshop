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
        private LoginPage          $loginPage,
        private CartPage           $cartPage,
        private FrontPage          $frontPage,
        private OrderedPage        $orderedPage,
        private ProductPage        $productPage,
        private SessionManager     $sessionManager
    ){}

    public function setRoutes(\Slim\App $app): void
    {
        $app->get('/',          function (Request $request, Response $response){
            $outputHtml = $this->frontPage->getProductsAll();
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('frontPage');

        $app->get('/login',    function (Request $request, Response $response) {
            if ($this->sessionManager->isLoggedIn()){
                return $response->withHeader('Location', '/'); //wenn schon eingeloggt
            }
            $loginPage = $this->loginPage->getPage();
            $response->getBody()->write($loginPage);
            return $response; //wenn nicht eingeloggt
        })->setName('loginPage');

        $app->post('/login',    function (Request $request, Response $response) {
            if($this->loginPage->login()){
                return $response->withHeader('Location', '/');
            }
            return $response->withHeader('Location', '/login');
        })->setName('login');

        $app->get('/logout',   function (Request $request, Response $response) {
            $this->sessionManager->logout();
            return $response->withHeader('Location', '/');
        })->setName('logout');


        $app->group('/admin',   function (RouteCollectorProxy $group){
            $group->get('',          function (Request $request, Response $response) {
                $outputHtml = $this->adminDashboardPage->getPage();
                $response->getBody()->write($outputHtml);
                return $response;
            })->setName('adminDashboard');
            $group->group('/orders', function (RouteCollectorProxy $group) {
                $group->get('/all',        function (Request $request, Response $response) {
                        $response->getBody()->write("orders - all");
                        return $response;
                    })->setName('adminOrdersAll');
                $group->get('/open',       function (Request $request, Response $response) {
                        $response->getBody()->write("orders - open");
                        return $response;
                    })->setName('adminOrdersOpen');
                $group->get('/inprogress', function (Request $request, Response $response) {
                        $response->getBody()->write("orders - in progresss");
                        return $response;
                    })->setName('adminOrdersInprogress');
                $group->get('/closed',     function (Request $request, Response $response) {
                        $response->getBody()->write("orders - closed");
                        return $response;
                    })->setName('adminOrdersClosed');
            });
        })->add(function (Request $request, RequestHandler $handler) use ($app) {
            $response = $handler->handle($request);
            $adminContent = (string) $response->getBody();

            $response = $app->getResponseFactory()->createResponse();

            if ($this->sessionManager->getRole() === ""){
                return $response->withHeader('Location', '/login');
            }

            if($this->sessionManager->getRole() > 9000){
                $response->getBody()->write($adminContent);
            } else {
                $response->getBody()->write("Du hast nicht genügend Rechte um auf die Seite zugreifen zu können.");
            }
            return $response;
        });

        $app->group('/product', function (RouteCollectorProxy $group){
            $group->get('/{productid}', function ( Request $request, Response $response,array $getArgs) {
                $productid = $getArgs['productid'];
                $outputHtml = $this->productPage->getProductByID($productid);
                $response->getBody()->write($outputHtml);
                return $response;
            })->setName('showProduct');
            $group->post('/addtocart',  function (Request $request, Response $response) {
                    $this->productPage->addItemToCart();
                    return $response->withHeader('Location', '/cart');
                })->setName('addToCart');
        });

        $app->group('/cart',    function (RouteCollectorProxy $group){
            $group->get('',                        function (Request $request, Response $response){
                $outputHtml = $this->cartPage->getCart();
                $response->getBody()->write($outputHtml);
                return $response;
            })->setName('showCart');
            $group->post('/deleteitem/{itemhash}', function (Request $request, Response $response,  array $getArgs){
                $itemhash = $getArgs['itemhash'];
                $this->sessionManager->deleteItemFromCart($itemhash);
                return $response->withHeader('Location', '/cart');
            })->setName('deleteItemFromCart');
            $group->post('/checkout',              function (Request $request, Response $response){
                $this->orderedPage->processOrder();
                $this->sessionManager->deleteCart();
                return $response->withHeader('Location', '/cart/checkout');
            })->setName('postCartCheckout');
            $group->get('/checkout',               function (Request $request, Response $response){
                $outputHtml = $this->orderedPage->showPageAfterOrdered();
                $response->getBody()->write($outputHtml);
                return $response;
            })->setName('getCartCheckout');
        });
    }
}