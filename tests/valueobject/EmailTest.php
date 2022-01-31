<?php
declare(strict_types=1);

namespace webShop;
use webShop\Email;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\Email
 */

final class EmailTest extends TestCase
{
    /**
     * @dataProvider badEmails
     */
    public function testBadEmails($badEmail) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        Email::fromString($badEmail);
        $this->fail("$badEmail was accepted as good!");
    }

    public function badEmails() : array
    {
        return [
            ["waytoolongbaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaad@email.de"],
            ["bad@email.email."], ["bäd@email.de"], ["bad@#mail.de"],[""],["@."],
            ["notgood@@gmail.de"],["wat.is.this.@gmail.com"], ["notgood@.de"]
        ];
    }

    /**
     * @dataProvider badTypeEmails
     */
    public function testBadEmailsWithTypeError($badEmail, $name) : void
    {
        $this->expectException(\TypeError::class);
        Email::fromString($badEmail);
        $this->fail("$name was accepted as good!");
    }

    public function badTypeEmails() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [012544244, "Integer"], [null, "Null"]
        ];
    }

    /**
     * @dataProvider goodEmails
     */
    public function testGoodEmails($goodEmail) : void
    {
        Email::fromString($goodEmail);
        $this->addToAssertionCount(1);
    }

    public function goodEmails() : array
    {
        return [["good@email.de"],['guteemail@email.com'],['a@b.de']];
    }
}
