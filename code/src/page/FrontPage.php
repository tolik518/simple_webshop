<?php

namespace webShop;

class FrontPage
{
    public function __construct(
        private FrontProjector   $frontProjector,
        private MySQLProductOverviewLoader $mySQLProductOverviewLoader,
        private VariablesWrapper $variablesWrapper
    ){}

    public function getProductsAll(): string
    {
        $productlist = $this->mySQLProductOverviewLoader->getProducts();
        return $this->frontProjector->getHtml($productlist);
    }
}