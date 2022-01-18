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

        $attributes     = $this->getAttributesByProductID($productid);

        $product = Product::set(
            (int)$result['product_id'],
            ProductName::fromString($result['name']),
            ProductDesc::fromString($result['description']),
            ProductDesc::fromString($result['short_description']),
            ProductDetail::fromString($result['details']),
            $attributes
        );

        return $product;
    }
    /**
     * Returns array with Attribute-Objects for given $productid <br>
     * when bool $onlynames is set on true, it will return a string-array with <br>
     * names of attributes from the product <br>
     *
     * @return Attribute[] | string[]
     */
    public function getAttributesByProductID(int $productid, bool $onlynames = false): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT attribute_id
                                                     FROM webshop.product_attributes
                                                     WHERE product_id = :product_id;');
        $sql->bindValue(':product_id', $productid);

        $sql->execute();
        $results = $sql->fetchAll(PDO::FETCH_COLUMN); //PDO::FETCH_COLUMN


        foreach ($results as $attribute_id){
            $sql = $this->mySQLConnector->prepare(
                'SELECT attributes.attribute_id, attributes.name, attributes.description, attribute_types.value, attribute_types.price
                       FROM webshop.attributes
                       INNER JOIN webshop.attributes_attribute_types
                       ON attributes.attribute_id = attributes_attribute_types.attribute_id 
                       INNER JOIN webshop.attribute_types
                       ON attributes_attribute_types.attribute_types_id = attribute_types.attribute_types_id
                       WHERE attributes.attribute_id = :attribute_id;'
            );
            $sql->bindValue(':attribute_id',$attribute_id);

            $sql->execute();
            $currentattribute = $sql->fetchAll(PDO::FETCH_ASSOC);
            if($onlynames)
            {
                $attribute[] = $currentattribute[0]["name"];
            } else
            {
                $attribute[$currentattribute[0]["name"]] = Attribute::set($currentattribute);
            }
        }

        if(!$onlynames)
        {
            $standartconfig = $this->getStandartConfigurationByProductID($productid);
            foreach ($attribute as $attributename => $attributeobject){
                $attributeobject->setSelected($standartconfig[$attributename]);
            }
        }

        return $attribute;
    }
    /**
     * Returns array with attribute-names as key and <br>
     * attribute-value as value. <br>
     * Example return: <code>
     * array(2) {
     *      ["Auflage"] => string(4) "1000"
     *      ["Format"] => string(2) "A5"
     * }
     * </code>
     * @return string[]
     */
    private function getStandartConfigurationByProductID(int $productid): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT attribute_types.name, attribute_types.value
                                                     FROM webshop.product_attributes
                                                     INNER JOIN webshop.attribute_types
                                                     ON product_attributes.standart_attribute_type_id = attribute_types.attribute_types_id 
                                                     WHERE product_id = :product_id;');
        $sql->bindValue(':product_id', $productid);

        $sql->execute();
        $results = $sql->fetchAll(PDO::FETCH_KEY_PAIR); //PDO::FETCH_COLUMN //PDO::FETCH_ASSOC


        return $results;
    }
}