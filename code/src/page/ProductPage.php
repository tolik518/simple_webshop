<?php

namespace webShop;

class ProductPage
{
    public function __construct(
        private MySQLProductLoader $mySQLProductLoader,
        private ProductProjector $productProjector,
        private SessionManager $sessionManager,
        private VariablesWrapper $variablesWrapper
    ){}

    public function getProductByID($productid): string
    {
        $product = $this->mySQLProductLoader->getProductByProductID($productid);

        return $this->productProjector->getHtml($product);
    }

    public function processOrder()
    {
        $id = $this->variablesWrapper->getPostParam("id");
        $attributes_expected = $this->mySQLProductLoader->getAttributesByProductID($id, true);

        /* @var $expected string */
        foreach ($attributes_expected as $expected){
            $attributes[$expected] = $this->variablesWrapper->getPostParam(str_replace(" ","_",$expected));
        }
        $productorder = ProductOrder::set($id, $attributes);

        $this->sessionManager->addToCart($productorder, $id);
    }
}