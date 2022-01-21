<?php
namespace webShop;

class Company
{
    private string $company;
    private function __construct(string $company)
    {
        $this->company = $this->validate($company);
    }

    private function validate($company) : string
    {
        if (strlen($company) > 100) {
            throw new \InvalidArgumentException("Der Firmenname ist zu lang. Bitte kürzen Sie ab.");
        }

        return htmlspecialchars($company);

    }

    public function __toString() : string
    {
        return $this->company;
    }

    public static function fromString(string $company)
    {
        return new self($company);
    }
}