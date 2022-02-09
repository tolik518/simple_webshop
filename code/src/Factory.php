<?php

namespace webShop;

class Factory
{
    public function createApplication(MySQLConnector $mySQLConnector): Application
    {
        return new Application(
            new Router(
                $this->createAdminDashboardPage($mySQLConnector),
                $this->createAPILoader($mySQLConnector),
                $this->createAdminLoginPage($mySQLConnector),
                $this->createCartPage($mySQLConnector),
                $this->createFrontPage($mySQLConnector),
                $this->createOrderedPage($mySQLConnector),
                $this->createProductPage($mySQLConnector),
                $this->createMiddlewareAdmin(),
                new SessionManager(),
                new TranslationMiddleware()
            )
        );
    }

    private function createAdminLoginPage($mySQLConnector): LoginPage
    {
        return new LoginPage(
            new LoginProjector(),
            new MySQLLogin(
                $mySQLConnector->getConnection()
            ),
            new SessionManager(),
            new VariablesWrapper(),
        );
    }

    private function createAPILoader($mySQLConnector): APILoader
    {
        return new APILoader(
            new MySQLAPI($mySQLConnector->getConnection())
        );
    }

    private function createAdminDashboardPage($mySQLConnector): AdminDashboardPage
    {
        return new AdminDashboardPage(
            new AdminDashboardProjector()
        );
    }

    private function createCartPage($mySQLConnector): CartPage
    {
        return new CartPage(
            new CartProjector(),
            new MySQLProductLoader(
                $mySQLConnector->getConnection()
            ),
            new SessionManager(),
            new VariablesWrapper()
        );
    }

    private function createOrderedPage($mySQLConnector): OrderedPage
    {
        return new OrderedPage(
          new MySQLOrder(
              $mySQLConnector->getConnection()
          ),
          new MySQLProductLoader(
              $mySQLConnector->getConnection()
          ),
          new OrderedProjector(),
          new SessionManager(),
          new VariablesWrapper()
        );
    }

    private function createProductPage($mySQLConnector): ProductPage
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

    private function createFrontPage($mySQLConnector): FrontPage
    {
       return new FrontPage(
            new FrontProjector(),
            new MySQLProductOverviewLoader(
                $mySQLConnector->getConnection()
            ),
            new VariablesWrapper()
        );
    }

    private function createMiddlewareAdmin(){
        return new AdminMiddleware(
            new SessionManager()
        );
    }
}