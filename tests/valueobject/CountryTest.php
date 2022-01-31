<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\Country
 */

class CountryTest extends TestCase
{
    /**
     * @dataProvider deniedCountries
     */
    public function testDeniedCities($deniedCountry) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        Country::fromString($deniedCountry);
        $this->fail("$deniedCountry was accepted as good!");
    }

    public function deniedCountries() : array
    {
        return [
            [""],['Russland'], ['USA'], ['Sri Lanka']
        ];
    }

    /**
     * @dataProvider badTypeCountries
     */
    public function testBadCountriesWithTypeError($badCountry, $name) : void
    {
        $this->expectException(\TypeError::class);
        Country::fromString($badCountry);
        $this->fail("$name was accepted as good!");
    }

    public function badTypeCountries() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [012544244, "Integer"], [null, "Null"]
        ];
    }

    /**
     * @dataProvider acceptedCountries
     */
    public function testAcceptedCities($acceptedCountry) : void
    {
        Country::fromString($acceptedCountry);
        $this->addToAssertionCount(1);
    }

    public function acceptedCountries() : array
    {
        return [
            ['Deutschland'], ['Österreich'], ['Schweiz']
        ];
    }
}
