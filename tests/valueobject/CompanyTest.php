<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\Company
 */

class CompanyTest extends TestCase
{
    /**
     * @dataProvider goodCompanies
     */
    public function testGoodCities($goodCompany) : void
    {
        Company::fromString($goodCompany);
        $this->addToAssertionCount(1);
    }

    public function goodCompanies() : array
    {
        return [
            ['google'], ['hipster@yourcity'], ['einstartupmit²namen'],[""]
        ];
    }

    /**
     * @dataProvider badTypeCompanies
     */
    public function testBadCompaniesWithTypeError($badCompany, $name) : void
    {
        $this->expectException(\TypeError::class);
        Company::fromString($badCompany);
        $this->fail("$name was accepted as good!");
    }

    public function badTypeCompanies() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [012544244, "Integer"], [null, "Null"]
        ];
    }

    public function testEscapingCompanyName()
    {
        $expected = "<script>";
        $company = Company::fromString($expected);
        $this->assertNotEquals($expected, $company);
    }

    public function testTooLongCompanyName() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        Company::fromString("VielZuLangerFirmenNameVielZuLangerFirmenNameVielZuLangerFirmenNameVielZuLangerFirmenNameAAAAAAAAAAAAa");
    }
}
