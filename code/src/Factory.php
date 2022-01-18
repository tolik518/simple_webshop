<?php

namespace webShop;

class Factory
{
    public function createApplication($mySQLConnector): Application
    {
        return new Application(
            new Router(
                $this->createAdminDashboardPage($mySQLConnector),
                $this->createCartPage($mySQLConnector),
                $this->createFrontPage($mySQLConnector),
                $this->createProductPage($mySQLConnector),
                new SessionManager()
            ),
            new VariablesWrapper()
        );
    }

    public function createAdminDashboardPage($mySQLConnector): AdminDashboardPage
    {
        return new AdminDashboardPage(
            new AdminDashboardProjector()
        );
    }

    public function createCartPage($mySQLConnector): CartPage
    {
        return new CartPage(
            new CartProjector(),
            new SessionManager(),
            new VariablesWrapper()
        );
    }

    public function createProductPage($mySQLConnector): ProductPage
    {
        return new ProductPage(
            new MySQLProductLoader(
                $mySQLConnector->getConnection()
            ),
            new ProductProjector(),
            new SessionManager(),
            new VariablesWrapper()
        );
    }

    public function createFrontPage($mySQLConnector): FrontPage
    {
       return new FrontPage(
            new FrontProjector(),
            new MySQLProductOverviewLoader(
                $mySQLConnector->getConnection()
            ),
            new VariablesWrapper()
        );
    }
}