<?php

namespace webShop;
use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;

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

    public function RoutesLoggedOut()
    {
        return [
            ["frontPage",          "GET", "/"],
            ["showProduct",        "GET", "/product/0"],
            ["addToCart",         "POST", "/product/addtocart"],
            ["showCart",           "GET", "/cart"],
            ["deleteItemFromCart","POST", "/cart/deleteitem/0"],
            ["postCartCheckout",  "POST", "/cart/checkout"],
            ["getCartCheckout",    "GET", "/cart/checkout"],
        ];
    }

    /**
     * @dataProvider RoutesLoggedOut
     * @runInSeparateProcess
     */
    public function testRoutesLoggedOut($expectedPage, $routeMethod, $routeUri)
    {
        $route = $this->app->getRouteCollector()->getRoutes()[
        $this->app
            ->getRouteResolver()
            ->computeRoutingResults($routeUri, $routeMethod)
            ->getRouteIdentifier()
        ]->getName();

        $this->assertSame($expectedPage,$route);
    }

    public function RouteArgs()
    {
        return [
            ["0",     "/product/", "productid", "GET"],
            ["100",   "/product/", "productid", "GET"],
            ["100",   "/cart/deleteitem/", "itemhash", "POST"],
            ["100",   "/cart/deleteitem/", "itemhash", "POST"]
        ];
    }

    /**
     * @dataProvider RouteArgs
     * @runInSeparateProcess
     */
    public function testRouteArgs($id, $route, $argName, $method){
        $args = $this->app
            ->getRouteResolver()
            ->computeRoutingResults($route.$id, $method)
            ->getRouteArguments();

        $this->assertSame($id, $args[$argName]);
    }
}
