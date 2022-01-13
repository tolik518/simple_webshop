<?php

namespace webShop;

class MySQLProductLoader
{
    public function __construct(
        private MySQLConnector|\PDO $mySQLConnector
    ){}
    
    public function getProductByID(int $productid): Product
    {
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                 FROM webshop.product
                                                 WHERE product_id = :product_id;');
        $sql->bindValue(':product_id', $productid);



        $sql->execute();
        $results = $sql->fetchAll();
        $result = $results[0];

        $product = Product::set(
            (int)$result['product_id'],
            ProductName::fromString($result['name']),
            ProductDesc::fromString($result['description']),
            ProductDesc::fromString($result['short_description']),
            ProductDetail::fromString($result['details']),
        );

        return $product;
    }
}