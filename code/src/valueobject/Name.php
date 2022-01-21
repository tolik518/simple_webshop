<?php
namespace webShop;

class Name
{
    private string $name;
    private function __construct(string $name)
    {
        $this->name = $this->validate($name);
    }

    private function validate($name) : string
    {
        if (strlen($name) > 60) {
            throw new \InvalidArgumentException("Der Name ist zu lang.");
        }

        if (!preg_match('/^\p{L}{2,}+(?:[\s]\p{L}{2,}+)*$/ui', $name)) {
            throw new \InvalidArgumentException("Der Name enthält unerlaubte Zeichen.");
        }

        return htmlspecialchars($name);
    }

    public function __toString() : string
    {
        return $this->name;
    }

    public static function fromString(string $name): Name
    {
        return new self($name);
    }
}