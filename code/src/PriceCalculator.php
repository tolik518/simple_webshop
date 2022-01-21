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
                if($attributename == "Auflage" ||$attributename ==  "Versand")
                {
                    if($attributename == "Auflage")
                    {
                        $auflage = $attributevalue;
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
                if($attributename == "Auflage" ||$attributename ==  "Versand")
                {
                    if($attributename == "Auflage")
                    {
                        $auflage[$index] = $attributevalue;
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