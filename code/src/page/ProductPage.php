<?php

namespace webShop;

class ProductPage
{
    public function __construct(
        private MySQLProductLoader $mySQLProductLoader,
        private ProductProjector $productProjector,
        private VariablesWrapper $variablesWrapper
    ){}

    public function getProductByID($productid): string
    {
        $product = $this->mySQLProductLoader->getProductByProductID($productid);

        return $this->productProjector->getHtml($product);
    }

    public function processOrder()
    {
        /* Artikel ID 1
         * array(8) {
              ["radioAuflage"]=>
              string(2) "30"
              ["radioFormat"]=>
              string(6) "0.0081"
              ["radioFalz"]=>
              string(6) "0.0001"
              ["radioOrientierung"]=>
              string(1) "0"
              ["radioPapierdicke"]=>
              string(6) "0.0002"
              ["radioAbgerundete_Ecken"]=>
              string(1) "0"
              ["radioVersand"]=>
              string(4) "5.99"
              ["radioMaterial"]=>
              string(6) "0.0011"
            }
         */
        /* Artikel ID 3
         * array(3) {
              ["radioAuflage"]=>
              string(2) "30"
              ["radioVersand"]=>
              string(4) "5.99"
              ["radioMaterial"]=>
              string(6) "0.0011"
            }
         */
        $attributes_expected = $this->mySQLProductLoader->getAttributesByProductID($this->variablesWrapper->getPostParam("id"), true);

        /* @var $expected string */
        foreach ($attributes_expected as $expected){
            $attributes[$expected] = $this->variablesWrapper->getPostParam(str_replace(" ","_",$expected));
        }
        echo "<pre>";
        var_dump($attributes);
        echo "______________________<br>";
        var_dump($_POST);
        die();
    }
}