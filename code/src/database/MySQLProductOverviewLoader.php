<?php

namespace webShop;

class MySQLProductOverviewLoader
{
    public function __construct(
        private MySQLConnector|\PDO $mySQLConnector
    ){}

    public function getProducts(): array
    {
        return [
            [
                'id' => 2,
                'group' => 0,
                'productname'=> 'Flyer, versch. Größen',
                'productshortdesc' => 'A4/A5/A6/DINlang uvm'
            ],
            [
                'id' => 1,
                'productname'=> 'Testartikel',
                'productshortdesc' => 'Testbeschreibung'
            ]
        ];
    }
}