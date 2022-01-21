<?php
namespace webShop;

class Phone
{
    private string $phone;
    private function __construct(string $phone)
    {
        $this->phone = $this->validate($phone);
    }

    private function validate($phone) : string
    {
        if (strlen($phone) > 24 || strlen($phone) < 6) {
            throw new \InvalidArgumentException("Die Telefonnummer ist ungültig (zu lang)");
        }

        if (!preg_match('/^([0-9\(\)\/\+( )\-]*)$/', htmlspecialchars($phone))) {
            throw new \InvalidArgumentException("Die Telefonnummer ist ungültig (unerwartete Zeichen)");
        }

        return $phone;
    }

    public function __toString() : string
    {
        return $this->phone;
    }

    public static function fromString(string $phone): Phone
    {
        return new self($phone);
    }
}