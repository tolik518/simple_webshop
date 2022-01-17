<?php

namespace webShop;

class MySQLProductOverviewLoader
{
    public function __construct(
        private MySQLConnector|\PDO $mySQLConnector
    ){}

    public function getProducts(): array
    {
       $sql = $this->mySQLConnector->prepare('SELECT *
                                                    FROM webshop.product;');

        $sql->execute();
        $results = $sql->fetchAll();

        $productList = [];
        foreach ($results as $result)
        {
            $productList[] = Product::set(
                (int)$result['product_id'],
                ProductName::fromString($result['name']),
                ProductDesc::fromString($result['description']),
                ProductDesc::fromString($result['short_description']),
                ProductDetail::fromString($result['details']),
                []  //Attribute sind leer, da unnötig an der Stelle
            );
        }
        return $productList;
    }
}