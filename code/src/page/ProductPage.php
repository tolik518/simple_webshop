<?php

namespace webShop;

class ProductPage
{
    public function __construct(
        private ProductProjector $productProjector
    ){}

    public function getProductByID(): string
    {
        return $this->productProjector->getHtml();
    }
}