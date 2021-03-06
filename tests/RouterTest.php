<?php

namespace webShop;
use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;

/**
 * @covers \webShop\Router
 */
class RouterTest extends TestCase
{
    protected $app;

    protected function setUp(): void
    {
        $mySQLConnectorMock = $this->getMockBuilder(MySQLConnector::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->app = AppFactory::create();
        $factory = new Factory();
        $factory->createApplication($mySQLConnectorMock)->start($this->app);
    }

    public function routesLoggedOut(): array
    {
        return [
            ["frontPage", "GET", "/"],

            ["showProduct",  "GET", "/product/0"],
            ["addToCart",   "POST", "/product/addtocart"],

            ["showCart",           "GET", "/cart"],
            ["deleteItemFromCart","POST", "/cart/deleteitem/0"],
            ["postCartCheckout",  "POST", "/cart/checkout"],
            ["getCartCheckout",    "GET", "/cart/checkout"],

            ["adminDashboard",  "GET", "/admin"],
            ["loginPage",      "GET", "/login"],
            ["logout",     "GET", "/logout"],

            ["adminOrdersAll",        "GET", "/admin/orders/all"],
            ["adminOrdersOpen",       "GET", "/admin/orders/open"],
            ["adminOrdersInprogress", "GET", "/admin/orders/inprogress"],
            ["adminOrdersClosed",     "GET", "/admin/orders/closed"]
        ];
    }

    /**
     * @dataProvider routesLoggedOut
     * @runInSeparateProcess
     */
    public function testRoutesLoggedOut($expectedPage, $routeMethod, $routeUri): void
    {
        $route = $this->app->getRouteCollector()->getRoutes()[
            $this->app
                ->getRouteResolver()
                ->computeRoutingResults($routeUri, $routeMethod)
                ->getRouteIdentifier()
            ]->getName();

        $this->assertSame($expectedPage,$route);
    }

    public function routeArgs(): array
    {
        return [
            ["0",   "/product/",         "productid", "GET"],
            ["100", "/product/",         "productid", "GET"],
            ["100", "/cart/deleteitem/", "itemhash",  "POST"],
            ["100", "/cart/deleteitem/", "itemhash",  "POST"]
        ];
    }

    /**
     * @dataProvider routeArgs
     * @runInSeparateProcess
     */
    public function testRouteArgs($id, $route, $argName, $method): void
    {
        $args = $this->app
            ->getRouteResolver()
            ->computeRoutingResults($route.$id, $method)
            ->getRouteArguments();

        $this->assertSame($id, $args[$argName]);
    }
}
