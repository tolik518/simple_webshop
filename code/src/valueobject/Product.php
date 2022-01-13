<?php

namespace webShop;

class Product
{
    private function __construct(private int $productId,
        private ProductName   $productName,
        private ProductDesc   $productDesc,
        private ProductDesc   $productShortDesc,
        private ProductDetail $productDetail
    ){}

    public static function set($productId, $productName, $productDesc, $productShortDesc, $productDetail){
        return new self($productId, $productName, $productDesc, $productShortDesc, $productDetail);
    }

    public function getProductID()
    {
        return $this->productId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductDesc()
    {
        return $this->productDesc;
    }

    public function getProductShortDesc()
    {
        return $this->productShortDesc;
    }

    public function getProductDetail()
    {
        return $this->productDetail;
    }

    public function getProductImage($n)
    {
        $image = $this->getProductID().'_'.$n.'.jpg';
        if (file_exists(PRODUCTIMAGES.$image))
        {
            return $image;
        }
        return "0_0.png";
    }
}