<?php

namespace webShop;

abstract class AbstractVO
{
    protected $value;
    protected function __construct($value)
    {
        $this->value = $this->validate($value);
    }

    abstract protected function validate($value);

    public function __toString(): string
    {
        return $this->value;
    }

    public static function fromString($value)
    {
        return new static($value);
    }
}