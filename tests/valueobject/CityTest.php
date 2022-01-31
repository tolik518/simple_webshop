<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\City
 */

class CityTest extends TestCase
{
    /**
     * @dataProvider badCities
     */
    public function testBadCities($badCity) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        City::fromString($badCity);
        $this->fail("$badCity was accepted as good!");
    }

    public function badCities() : array
    {
        return [
            [""],['420City'],['City¹'],['Im@home'],['Zuuuuuulaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaan']
        ];
    }

    /**
     * @dataProvider badTypeCities
     */
    public function testBadCitiesWithTypeError($badCity, $name) : void
    {
        //xdebug_info();
        $this->expectException(\TypeError::class);
        City::fromString($badCity);
        $this->fail("$name was accepted as good!");

    }

    public function badTypeCities() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [012544244, "Integer"], [null, "Null"]
        ];
    }

    /**
     * @dataProvider goodCities
     */
    public function testGoodCities($goodCity) : void
    {
        City::fromString($goodCity);
        $this->addToAssertionCount(1);
    }

    public function goodCities() : array
    {
        return [
            ['Doberan'], ['Würzburg'], ['Bad Doberan'],['Baden-Baden']
        ];
    }
}
