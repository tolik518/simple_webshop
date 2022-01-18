<?php

namespace webShop;

class ProductOrder
{
    private function __construct(
        private int   $productId,
        private array $attributes
    ){}

    public static function set($productId, $attributes){
        return new self($productId, $attributes);
    }

    public function getId(): int
    {
        return $this->productId;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}