<?php

namespace webShop;

class Factory
{
    public function createApplication(): Application
    {
        return new Application(
            new Router(
                $this->createAdminDashboardPage(),
                $this->createFrontPage(),
                $this->createProductPage(),
                new SessionManager()
            ),
            new VariablesWrapper()
        );
    }

    public function createAdminDashboardPage(): AdminDashboardPage
    {
        return new AdminDashboardPage(
            new AdminDashboardProjector()
        );
    }

    public function createProductPage(): ProductPage
    {
        return new ProductPage(
            new ProductProjector()
        );
    }

    public function createFrontPage(): FrontPage
    {
       return new FrontPage(
            new FrontProjector(),
            new MySQLProductOverviewLoader(
                new MySQLConnector()
            ),
            new VariablesWrapper()
        );
    }
}