<?php
namespace webShop;

class City
{
    private string $city;
    private function __construct(string $city)
    {
        $this->city = $this->validate($city);
    }

    private function validate($city) : string
    {
        if (strlen($city) > 60) {
            throw new \InvalidArgumentException("Der Stadtname ist zu lang.");
        }

        if (!preg_match('/^\p{L}{2,}+(?:[\s-]\p{L}{2,}+)*$/ui', $city)) {
            throw new \InvalidArgumentException("Der Stadtname enthält unerlaubte Zeichen (sorry).");
        }

        return htmlspecialchars($city);
    }

    public function __toString() : string
    {
        return $this->city;
    }

    public static function fromString(string $city): City
    {
        return new self($city);
    }
}