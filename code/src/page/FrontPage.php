<?php

namespace webShop;

use JetBrains\PhpStorm\Pure;

class FrontPage
{
    public function __construct(
        private FrontProjector   $frontProjector,
        private MySQLProductOverviewLoader $mySQLProductOverviewLoader,
        private VariablesWrapper $variablesWrapper
    ){}

    public function getProductsAll(): string
    {
        $products = $this->mySQLProductOverviewLoader->getProducts();
        return $this->frontProjector->getHtml($products);
    }
}