<?php

namespace webShop;

class MySQLAPI
{
    public function __construct(
        private \PDO $mySQLConnector
    ){}

    public function orders(): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                 FROM webshop.orders');
        $sql->execute();
        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function fullorders(): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT product.name, ordered_products.item_id
                                                 FROM webshop.orders
                                                 INNER JOIN webshop.ordered_products
                                                 ON orders.order_id = ordered_products.order_id
                                                 INNER JOIN webshop.product
                                                 ON ordered_products.product_id = product.product_id');
        $sql->execute();
        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function orderById($id): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                 FROM webshop.orders
                                                 WHERE order_id = :id;');
        $sql->bindValue(':id', $id);
        $sql->execute();
        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOrdersToday(): array
    {
        $todaysql = $this->mySQLConnector->prepare('SELECT DATE(NOW())');
        $todaysql->execute();
        $today = $todaysql->fetch()[0];

        $sql = $this->mySQLConnector->prepare('SELECT *
                                                 FROM webshop.orders
                                                 WHERE ordered_at LIKE :today');
        $sql->bindValue(":today", $today."%");

        $sql->execute();
        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOrderedProducts(): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                 FROM webshop.ordered_products;');
        $sql->execute();
        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOrderedProductsByOrderId($id): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                 FROM webshop.ordered_products
                                                 WHERE order_id = :id;');
        $sql->bindValue(':id', $id);
        $sql->execute();
        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOrderedProductsByOrderIdAndHash($id, $hash): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                 FROM webshop.ordered_products
                                                 WHERE order_id = :id AND item_id = :item_id;');
        $sql->bindValue(':id', $id);
        $sql->bindValue(':item_id', $hash);
        $sql->execute();
        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function getOrderedProductsByOrderIdAndProductID($id, $product_id): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                 FROM webshop.ordered_products
                                                 WHERE order_id = :id AND product_id = :product_id;');
        $sql->bindValue(':id', $id);
        $sql->bindValue(':product_id', $product_id);
        $sql->execute();
        $result = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}