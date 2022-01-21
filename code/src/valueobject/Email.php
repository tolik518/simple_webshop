<?php
namespace webShop;

class Email
{
    private string $email;
    public function __construct(string $email)
    {
        $this->email = $this->validate($email);
    }

    private function validate($email) : string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Ungültige Email:<br /> E-Mail sollte wie folgt aussehen name@mail.de');
        }

        if ($email == 'name@mail.de') {
            throw new \InvalidArgumentException('Ungültige Email:<br /> name@mail.de ist ganz bestimmt nicht deine E-Mail');
        }

        return $email;
    }

    public function __toString() : string
    {
        return $this->email;
    }

    public static function fromString(string $email): Email
    {
        return new self($email);
    }
}