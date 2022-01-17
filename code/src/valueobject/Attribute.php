<?php

namespace webShop;

class Attribute
{
    protected int $id;
    protected string $name;
    protected string $description;

    protected array $valueprice;
    protected string $standartvalue;

    protected function __construct($configurations)
    {
        $this->id = $configurations[0]["attribute_id"];
        $this->name = $configurations[0]["name"];
        $this->description = $configurations[0]["description"];

        foreach ($configurations as $conf) {
            $this->valueprice[$conf["value"]] = $conf["price"];
        }
    }

    public static function set($configurations): static
    {
        return new static($configurations);
    }

    public function setStandart($value): void
    {
        $this->standartvalue = $value;
    }

    public function getStandart(): string
    {
        return $this->standartvalue;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPriceForValue(string $value): int
    {
        return $this->valueprice[$value];
    }

    public function getPriceForValueArray(): array
    {
        return $this->valueprice;
    }
}