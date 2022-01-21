<?php
namespace webShop;

class Adress
{
    protected function __construct(
        private Email $email,
        private Name $firstname,
        private Name $lastname,
        private Street $street,
        private ZipCode $zipCode,
        private City $city,
        private State $state,
        private Country $country,
        private Phone $phone,
        private Company $company
    ){}

    public static function set(...$entry)
    {
        return new self(...$entry);
    }

    public function getEmail(): string
    {
        return (string)$this->email;
    }

    public function getCity(): string
    {
        return (string)$this->city;
    }

    public function getFirstname(): string
    {
        return (string)$this->firstname;
    }

    public function getLastname(): string
    {
        return (string)$this->lastname;
    }

    public function getStreet(): string
    {
        return (string)$this->street;
    }

    public function getZipCode(): string
    {
        return (string)$this->zipCode;
    }

    public function getState(): string
    {
        return (string)$this->state;
    }

    public function getCountry(): string
    {
        return (string)$this->country;
    }

    public function getPhone(): string
    {
        return (string)$this->phone;
    }

    public function getCompany(): string
    {
        return (string)$this->company;
    }
}