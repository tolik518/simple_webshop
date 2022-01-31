<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\Phone
 */
class PhoneTest extends TestCase
{
    /**
     * @dataProvider badPhonenumbers
     */
    public function testBadPhonenumbers($badPhonenumber) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        Phone::fromString($badPhonenumber);
        $this->fail("$badPhonenumber was accepted as good!");
    }

    public function badPhonenumbers() : array
    {
        return [
            [""],['03011'],['Telefonnummer']
        ];
    }

    /**
     * @dataProvider badTypePhonenumbers
     */
    public function testBadPhonenumbersWithTypeError($badPhonenumber, $name) : void
    {
        $this->expectException(\TypeError::class);
        Phone::fromString($badPhonenumber);
        $this->fail("$name was accepted as good!");
    }

    public function badTypePhonenumbers() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [012544244, "Integer"], [null, "Null"]
        ];
    }

    /**
     * @dataProvider goodPhonenumbers
     */
    public function testGoodPhonenumbers($goodPhonenumber) : void
    {
        Phone::fromString($goodPhonenumber);
        $this->addToAssertionCount(1);
    }

    public function goodPhonenumbers() : array
    {
        return [
            ['0301756176'],['030 1756176'],['+490301756176'],['+49 030-1756-176']
        ];
    }
}
