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

    public function addItemToCart(): void
    {
        $id = $this->variablesWrapper->getPostParam("id");
        $attributes_expected = $this->mySQLProductLoader->getAttributesByProductID($id, true);

        /* @var $expected string */
        foreach ($attributes_expected as $expected){
            $attributes[$expected] = $this->variablesWrapper->getPostParam(str_replace(" ","_",$expected))??"0";
        }
        $productorder = ProductOrder::set($id, $attributes);

        $this->sessionManager->addToCart($productorder);
    }
}