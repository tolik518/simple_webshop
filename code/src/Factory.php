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
                new SessionManager()
            ),
            new VariablesWrapper()
        );
    }

    public function createAdminDashboardPage()
    {
        return new AdminDashboardPage(
            new AdminDashboardProjector()
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