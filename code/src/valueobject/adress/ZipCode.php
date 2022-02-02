<?php
namespace webShop;

class ZipCode
{
    private string $zipcode;
    private function __construct(string $zipcode)
    {
        $this->zipcode = $this->validate($zipcode);
    }

    private function validate($zipcode) : string
    {
        if (strlen($zipcode) > 6) {
            throw new \InvalidArgumentException("Die Postleihzahl ist zu lang.");
        }

        if (preg_match('/^[0-9]{4,6}$/', $zipcode)) {
            return htmlspecialchars($zipcode);
        }

        throw new \InvalidArgumentException("Die Postleitzahl enthält unerlaubte Zeichen.");

    }

    public function __toString() : string
    {
        return $this->zipcode;
    }

    public static function fromString(string $zipcode): ZipCode
    {
        return new self($zipcode);
    }
}