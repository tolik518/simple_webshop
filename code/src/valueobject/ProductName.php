<?php

namespace webShop;

class ProductName extends AbstractVO
{
    protected function validate($value): string
    {
        if(strlen($value) > 75)
        {
            throw new \InvalidArgumentException("Der Name ist zu lang (max 75 Zeichen)");
        }

        return htmlspecialchars($value) ?? "Unbekannter Artikel";
    }
}