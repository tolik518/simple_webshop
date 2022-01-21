<?php

namespace webShop;

class ProductOrder
{
    private function __construct(
        private int   $productId,
        private array $attributes,
        private string $hash
    ){}

    public static function set($productId, $attributes){
        return new self($productId, $attributes, hash("md5", implode($attributes)));
    }

    public function getId(): int
    {
        return $this->productId;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}