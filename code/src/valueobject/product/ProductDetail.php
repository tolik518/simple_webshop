<?php

namespace webShop;

class ProductDetail extends AbstractVO
{
    protected function validate($value): string
    {
        if(strlen($value) > 500)
        {
            throw new \InvalidArgumentException("Die Produkt-Details sind zu lang (max 500 Zeichen)");
        }

        return htmlspecialchars($value) ?? "";
    }

    public static function toHTML(string $value): string
    {
        $value = str_replace('*', '<li>', htmlspecialchars($value));
        return $value;
    }
}