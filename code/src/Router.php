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
        private APILoader          $APILoader,
        private LoginPage          $loginPage,
        private CartPage           $cartPage,
        private FrontPage          $frontPage,
        private OrderedPage        $orderedPage,
        private ProductPage        $productPage,
        private MiddlewareAdmin    $middlewareAdmin,
        private SessionManager     $sessionManager
    ){}

    public function setRoutes(\Slim\App $app): void
    {
        $app->get('/',       function (Request $request, Response $response) {
            $outputHtml = $this->frontPage->getProductsAll();
            $response->getBody()->write($outputHtml);
            return $response;
        })->setName('frontPage');
        $app->get('/login',  function (Request $request, Response $response) {
            if ($this->sessionManager->isLoggedIn()){
                return $response->withHeader('Location', '/'); //wenn schon eingeloggt
            }
            $loginPage = $this->loginPage->getPage();
            $response->getBody()->write($loginPage);
            return $response; //wenn nicht eingeloggt
        })->setName('loginPage');
        $app->post('/login', function (Request $request, Response $response) {
            if($this->loginPage->login()){
                return $response->withHeader('Location', '/');
            }
            return $response->withHeader('Location', '/login');
        })->setName('login');
        $app->get('/logout', function (Request $request, Response $response) {
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
            $group->group('/api', function (RouteCollectorProxy $group){
                $group->group('/v1', function (RouteCollectorProxy $group){
                    $group->get('/fullorders', function ( Request $request, Response $response) {
                        $outputHtml = $this->APILoader->getFullorders();
                        $response->getBody()->write($outputHtml);
                        return $response;
                    })->setName('api/v1/orders');
                    $group->get('/orders', function ( Request $request, Response $response) {
                        $outputHtml = $this->APILoader->getOrder();
                        $response->getBody()->write($outputHtml);
                        return $response;
                    })->setName('api/v1/orders');
                    $group->get('/orders/today', function ( Request $request, Response $response) {
                        $outputHtml = $this->APILoader->getOrdersToday();
                        $response->getBody()->write($outputHtml);
                        return $response;
                    })->setName('api/v1/orders/today');
                    $group->get('/orders/{orderid}', function ( Request $request, Response $response, array $getArgs) {
                        $outputHtml = $this->APILoader->getOrderByOrderId($getArgs['orderid']);
                        $response->getBody()->write($outputHtml);
                        return $response;
                    })->setName('api/v1/orders/{orderid}');
                    $group->group('/ordered_products', function (RouteCollectorProxy $group){
                        $group->get('', function ( Request $request, Response $response) {
                        $outputHtml = $this->APILoader->getOrderedProducts();
                        $response->getBody()->write($outputHtml);
                        return $response;
                    })->setName('api/v1/ordered_products');
                        $group->get('/{orderid}', function ( Request $request, Response $response, array $getArgs) {
                        $outputHtml = $this->APILoader->getOrderedProductsByOrderId($getArgs['orderid']);
                        $response->getBody()->write($outputHtml);
                        return $response;
                    })->setName('api/v1/ordered_products/{orderid}');
                        $group->get('/{orderid}/item_id/{hash}', function ( Request $request, Response $response, array $getArgs) {
                        $outputHtml = $this->APILoader->getOrderedProductsByOrderIdAndHash($getArgs['orderid'], $getArgs['hash']);
                        $response->getBody()->write($outputHtml);
                        return $response;
                    })->setName('api/v1/ordered_products/{orderid}/item_id/{hash}');
                        $group->get('/{orderid}/product_id/{product_id}', function ( Request $request, Response $response, array $getArgs) {
                        $outputHtml = $this->APILoader->getOrderedProductsByOrderIdAndProductID($getArgs['orderid'], $getArgs['product_id']);
                        $response->getBody()->write($outputHtml);
                        return $response;
                    })->setName('api/v1/ordered_products/{orderid}/product_id/{product_id}');
                    });
                });
            });
        })->add($this->middlewareAdmin);

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

        $app->group('/cart', function (RouteCollectorProxy $group){
            $group->get('', function (Request $request, Response $response){
                $outputHtml = $this->cartPage->getCart();
                $response->getBody()->write($outputHtml);
                return $response;
            })->setName('showCart');
            $group->get('/checkout', function (Request $request, Response $response){
                $outputHtml = $this->orderedPage->showPageAfterOrdered();
                $response->getBody()->write($outputHtml);
                return $response;
            })->setName('getCartCheckout');
            $group->post('/checkout', function (Request $request, Response $response){
                $this->orderedPage->processOrder();
                $this->sessionManager->deleteCart();
                return $response->withHeader('Location', '/cart/checkout');
            })->setName('postCartCheckout');
            $group->post('/deleteitem/{itemhash}', function (Request $request, Response $response,  array $getArgs){
                $itemhash = $getArgs['itemhash'];
                $this->sessionManager->deleteItemFromCart($itemhash);
                return $response->withHeader('Location', '/cart');
            })->setName('deleteItemFromCart');
        });
    }
}