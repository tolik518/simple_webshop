<?php

namespace webShop;

class ProductPage
{
    public function __construct(
        private MySQLProductLoader $mySQLProductLoader,
        private ProductProjector $productProjector
    ){}

    public function getProductByID($productid): string
    {
        $product = $this->mySQLProductLoader->getProductByProductID($productid);

        return $this->productProjector->getHtml($product);
    }
}