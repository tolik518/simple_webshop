<?php
namespace webShop;

class Street
{
    private string $street;
    private function __construct(string $street)
    {
        $this->street = $this->validate($street);
    }

    private function validate($street) : string
    {
        if (strlen($street) > 70 || strlen($street) < 2) {
            throw new \InvalidArgumentException("Der Straßenname ist zu lang oder zu kurz.");
        }

        return htmlspecialchars($street);
    }

    public function __toString() : string
    {
        return $this->street;
    }

    public static function fromString(string $street): Street
    {
        return new self($street);
    }
}