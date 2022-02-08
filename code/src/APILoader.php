<?php

namespace webShop;

class APILoader
{
    public function __construct(
        private MySQLAPI $mySQLAPI
    ){}

    public function getOrder(): string
    {
        return json_encode($this->mySQLAPI->orders());
    }

    public function getFullorders(): string
    {
        return json_encode($this->mySQLAPI->fullorders());
    }

    public function getOrderByOrderId($id): string
    {
        return json_encode($this->mySQLAPI->orderById($id));
    }

    public function getOrdersToday(): string
    {
        return json_encode($this->mySQLAPI->getOrdersToday());
    }

    public function getOrderedProducts(): string
    {
        return json_encode($this->mySQLAPI->getOrderedProducts());
    }

    public function getOrderedProductsByOrderId($id): string
    {
        return json_encode($this->mySQLAPI->getOrderedProductsByOrderId($id));
    }

    public function getOrderedProductsByOrderIdAndHash($id, $hash): string
    {
        return json_encode($this->mySQLAPI->getOrderedProductsByOrderIdAndHash($id, $hash));
    }

    public function getOrderedProductsByOrderIdAndProductID($id, $product_id): string
    {
        return json_encode($this->mySQLAPI->getOrderedProductsByOrderIdAndProductID($id, $product_id));
    }
}