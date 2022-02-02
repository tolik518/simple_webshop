<?php

namespace webShop;

use PDO;

class MySQLOrder
{
    public function __construct(
        private \PDO $mySQLConnector
    ){}

    /** @var $cart ProductOrder[]*/
    public function makeOrder(Adress $address, array $cart)
    {
        $sql_address = $this->mySQLConnector->prepare(
            'INSERT INTO webshop.customers(email, firstname, lastname, street, zipcode, city, state, country, phone, company)
                   VALUES (:email, :firstname, :lastname, :street, :zipcode, :city, :state, :country, :phone, :company);'
        );

        $sql_address->bindValue(':email',     $address->getEmail());
        $sql_address->bindValue(':firstname', $address->getFirstname());
        $sql_address->bindValue(':lastname',  $address->getLastname());
        $sql_address->bindValue(':street',    $address->getStreet());
        $sql_address->bindValue(':zipcode',   $address->getZipCode());
        $sql_address->bindValue(':city',      $address->getCity());
        $sql_address->bindValue(':state',     $address->getState());
        $sql_address->bindValue(':country',   $address->getCountry());
        $sql_address->bindValue(':phone',     $address->getPhone());
        $sql_address->bindValue(':company',   $address->getCompany());
        $sql_address->execute();

        $customer_id = $this->mySQLConnector->lastInsertId();

        $sql_new_order = $this->mySQLConnector->prepare(
            'INSERT INTO webshop.orders(customer_id, price)
                   VALUES (:customer_id, :price);'
        );

        $sql_new_order->bindValue(':customer_id', $customer_id);
        $sql_new_order->bindValue(':price', 0.0);
        $sql_new_order->execute();

        $order_id = $this->mySQLConnector->lastInsertId();

        $sql_ordered_products = $this->mySQLConnector->prepare(
            'INSERT INTO webshop.ordered_products(order_id, product_id, attribute_id, selected_attribute_type_id, item_id)
                   VALUES (:order_id, :product_id, :attribute_id, :selected_attribute_type_id, :item_id);'
        );

        foreach ($cart as $item)
        {
            $sql_attribute_id = $this->mySQLConnector->prepare('SELECT attribute_id
                                                                     FROM webshop.attributes
                                                                     WHERE name = :name;');

            $sql_selected_id  = $this->mySQLConnector->prepare('SELECT attribute_types_id
                                                                      FROM webshop.attribute_types
                                                                      WHERE value = :value
                                                                      AND name = :name;');

            $sql_ordered_products->bindValue(':order_id', $order_id);
            $sql_ordered_products->bindValue(':product_id', $item->getId());
            $sql_ordered_products->bindValue(':item_id', $item->getHash());

            $attributes = $item->getAttributes();
            //Hier holen wir uns erstmal die attribut IDs passend zum attributnamen aus der datenbank
            foreach ($attributes as $attribute_name => $attribute_value)
            {
                $sql_attribute_id->bindValue(':name', $attribute_name);
                $sql_attribute_id->execute();
                $fetched_attribute_id = $sql_attribute_id->fetch();

                $sql_selected_id->bindValue(':value', $attribute_value);
                $sql_selected_id->bindValue(':name',  $attribute_name);
                $sql_selected_id->execute();
                $fetched_selected_id = $sql_selected_id->fetch();

                $sql_ordered_products->bindValue(':attribute_id', $fetched_attribute_id[0]);
                $sql_ordered_products->bindValue(':selected_attribute_type_id', $fetched_selected_id[0]);

                $sql_ordered_products->execute();
            }
        }
    }
}