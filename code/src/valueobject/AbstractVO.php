<?php

namespace webShop;

abstract class AbstractVO
{
    protected string $value;
    protected function __construct($value)
    {
        $this->value = $this->validate($value);
    }

    abstract protected function validate($value): string;

    public function __toString(): string
    {
        return $this->value;
    }

    public static function fromString($value): static
    {
        return new static($value);
    }
}