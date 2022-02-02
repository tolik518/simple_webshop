<?php

namespace webShop;

class ProductDesc extends AbstractVO
{
    protected function validate($value): string
    {
        if(strlen($value) > 2000)
        {
            throw new \InvalidArgumentException("Die Beschreibung ist zu lang (max 2000 Zeichen)");
        }
        return $value ?? "";
    }

    public static function toHTML(string $value): string
    {
        $value = str_replace('*', '<li>', htmlspecialchars($value));
        return $value;
    }
}