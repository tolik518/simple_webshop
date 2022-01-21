<?php
namespace webShop;

class Country
{
    private string $country;
    private function __construct(string $country)
    {
        $this->country = $this->validate($country);
    }

    private function validate($country): string
    {
        if (strlen($country) > 30) {
            throw new \InvalidArgumentException("Der Landesname ist zu lang.");
        }

        switch ($country) {
            case 'Deutschland':
                return 'Deutschland';
            case 'Österreich':
                return 'Österreich';
            case 'Schweiz':
                return 'Schweiz';
            default:
                throw new \InvalidArgumentException("In $country sind die Bestellungen noch nicht verfügbar");
        }
    }

    public function __toString(): string
    {
        return $this->country;
    }

    public static function fromString(string $country): Country
    {
        return new self($country);
    }
}