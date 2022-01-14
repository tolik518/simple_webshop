<?php

namespace webShop;

use PDO;

class MySQLProductLoader
{
    public function __construct(
        private MySQLConnector|PDO $mySQLConnector
    ){}
    
    public function getProductByProductID(int $productid): Product
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

    public function getAttributesByProductID(int $productid)
    {
        $sql = $this->mySQLConnector->prepare('SELECT attribute_id
                                                     FROM webshop.product_attributes
                                                     WHERE product_id = :product_id;');
        $sql->bindValue(':product_id', $productid);

        $sql->execute();
        $results = $sql->fetchAll(PDO::FETCH_COLUMN);

        foreach ($results as $attribute_id){
            $sql = $this->mySQLConnector->prepare('SELECT attributes.attribute_id, attributes.name, attributes.description, attribute_types.value, attribute_types.price
                                                         FROM webshop.attributes
                                                         INNER JOIN webshop.attributes_attribute_types
                                                         ON attributes.attribute_id = attributes_attribute_types.attribute_id 
                                                         INNER JOIN webshop.attribute_types
                                                         ON attributes_attribute_types.attribute_types_id = attribute_types.attribute_types_id
                                                         WHERE attributes.attribute_id = :attribute_id;');
            $sql->bindValue(':attribute_id', $attribute_id);

            $sql->execute();
            $currentattribute = $sql->fetchAll(PDO::FETCH_ASSOC);
            $attribute[$currentattribute[0]['name']] = $currentattribute; //PDO::FETCH_ASSOC
        }
        //TODO: make a VO

        return $attribute;
    }
}