<?php

namespace webShop;

class AdminDashboardPage
{
    public function __construct(
        private AdminDashboardProjector $adminDashboardProjector
    ){}

    public function getPage(): string
    {
        return $this->adminDashboardProjector->getHtml();
    }
}