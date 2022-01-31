<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\Street
 */
class StreetTest extends TestCase
{
    /**
     * @dataProvider badStreets
     */
    public function testBadStreets($badStreet) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        Street::fromString($badStreet);
        $this->fail("$badStreet was accepted as good!");
    }

    public function badStreets() : array
    {
        return [ ['DasIstEinVielZuLanger Straßenname und es gehen bis zu 70 Zeichen naja also'],
        ];
    }
    /**
     * @dataProvider badTypeStreets
     */
    public function testBadStreetsWithTypeError($badStreet, $badStreetName) : void
    {
        $this->expectException(\TypeError::class);
        Street::fromString($badStreet);
        $this->fail("$badStreetName was accepted as good!");
    }

    public function badTypeStreets() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [012544244, "Integer"], [null, "Null"]
        ];
    }


    /**
     * @dataProvider goodStreets
     */
    public function testGoodStreets($goodStreets) : void
    {
        Street::fromString($goodStreets);
        $this->addToAssertionCount(1);
    }

    public function goodStreets() : array
    {
        return [
            ['Str. 600 15'], ['Hansastraße 15a'], ['Mariahilfer Straße 38–40'],
            ['Bergisch Gladbacher Straße 263 z'], ['Stockumer Straße 398 1⁄2 '],
            ['Margaretenplatz 55 b 1'], ['B 2']
        ];
    }

    public function testEscapingStreetNames()
    {
        $expected = "<script>";
        $street = Street::fromString($expected);
        $this->assertNotEquals($expected, $street);
    }
}
