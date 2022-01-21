<?php
namespace webShop;

class State
{
    private string $state;
    private function __construct(string $state)
    {
        $this->state = $this->validate($state);
    }

    private function validate(string $state) : string
    {
        if (strlen($state) > 30 || strlen($state) < 3) {
            throw new \InvalidArgumentException("Der Bundeslandname ist zu lang.");
        }

        if (!preg_match('/^\p{L}{2,}+(?:[\s-]\p{L}{2,}+)*$/ui', $state)) {
            throw new \InvalidArgumentException("Der Bundeslandname enthält unerlaubte Zeichen.");
        }

        return htmlspecialchars($state);
    }

    public function __toString() : string
    {
        return $this->state;
    }

    public static function fromString(string|null $state): State
    {
        if($state == null || $state == ""){
            $state = "Unbekannt";
        }
        return new self($state);
    }
}