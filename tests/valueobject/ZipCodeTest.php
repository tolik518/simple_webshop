<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\ZipCode
 */

class ZipCodeTest extends TestCase
{
    /**
     * @dataProvider badZipCodes
     */
    public function testBadZipCodes($zipCodes) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        ZipCode::fromString($zipCodes);
        $this->fail("$zipCodes was accepted as good!");
    }

    public function badZipCodes() : array
    {
        return [
            [''],['123'], ['12345678']
        ];
    }

    /**
     * @dataProvider badTypeZipCodes
     */
    public function testBadZipCodesWithTypeError($badZipCode, $badZipCodeName) : void
    {
        $this->expectException(\TypeError::class);
        ZipCode::fromString($badZipCode);
        $this->fail("$badZipCodeName was accepted as good!");
    }

    public function badTypeZipCodes() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [012544244, "Integer"], [null, "Null"]
        ];
    }

    /**
     * @dataProvider goodZipCodes
     */
    public function testGoodZipCodes($goodZipCode) : void
    {
        ZipCode::fromString($goodZipCode);
        $this->addToAssertionCount(1);
    }

    public function goodZipCodes() : array
    {
        return [
            ['12346'],['97080'],['01234']
        ];
    }
}
