<?php

namespace webShop;

class Factory
{
    public function createApplication(): Application
    {
        return new Application(
            new Router(
                $this->createFrontPage(),
                new SessionManager()
            ),
            new VariablesWrapper()
        );
    }

    public function createFrontPage(): FrontPage
    {
       return new FrontPage(
            new FrontProjector(),
            new VariablesWrapper()
        );
    }
}