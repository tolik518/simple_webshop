<?php

namespace webShop;

class PriceCalculator
{
    /**
     * Returns a price for the whole order as a float value
     */
    public static function calculatePriceForOrder(array $productOrders, array $products): float
    {
        $pricetotal = 0;
        $auflage    = 0;
        /** @var $order ProductOrder */
        foreach ($productOrders as $index => $order)
        {
            foreach ($order->getAttributes() as $attributename => $attributevalue)
            {
                /** @var $attribute Attribute */
                $attribute = $products[$index]->getAttribute($attributename);
                if($attributename === "attributes_quantity" ||$attributename ===  "attributes_shipping")
                {
                    if($attributename === "attributes_quantity")
                    {
                        /* die variable die wir bekommen sieht so aus "attributes_quantity_10000" deswegen müssen wir das
                            attributes_quantity erstmal rauslöschen */
                        $auflage = (int)str_replace("attributes_quantity_", "", $attributevalue);;
                    }
                    $pricetotal += $attribute->getPriceForValue($attributevalue??0);
                } else {
                    $pricetotal += $auflage*$attribute->getPriceForValue($attributevalue??0);
                }

            }
        }
        return round($pricetotal, 2);
    }

    /**
     * Returns prices for all ordered products, individually, in an array of float values
     * @var $products Product[]
     */
    public static function calculatePrices(array $productOrders, array $products): array
    {
        $prices = [];
        $auflage = [];

        /** @var $order ProductOrder */
        foreach ($productOrders as $index => $order)
        {
            $prices[$index] = 0;
            foreach ($order->getAttributes() as $attributename => $attributevalue)
            {
                /** @var $attribute Attribute */
                $attribute = $products[$index]->getAttribute($attributename);
                if($attributename === "attributes_quantity" || $attributename === "attributes_shipping")
                {
                    if($attributename === "attributes_quantity"){
                        /* die variable die wir bekommen sieht so aus "attributes_quantity_10000" deswegen müssen wir das
                             attributes_quantity erstmal rauslöschen */
                        $auflage[$index] = (int)str_replace("attributes_quantity_", "", $attributevalue);
                    }
                    $prices[$index] += round($attribute->getPriceForValue($attributevalue??0), 2);
                } else {
                    $prices[$index] += round($auflage[$index]*$attribute->getPriceForValue($attributevalue??0),2);
                }
            }
        }
        return $prices;
    }
}