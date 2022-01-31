<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\Name
 */
final class NameTest extends TestCase
{
    /**
     * @dataProvider goodNames
     */
    public function testCorrectNameInput($goodName)
    {
        try {
            $this->assertEquals($goodName, Name::fromString($goodName));
        } catch (\InvalidArgumentException $notExpected) {
            $this->fail("$goodName failed irgendwie kp");
        }
    }

    public function goodNames() : array
    {
        return [
            ["Björn"],["Peter"],["anderson"],['Ülüdür'],["Cüŝ"],["Dominik Jonas"]
        ];
    }

    /**
     * @dataProvider badTypeNames
     */
    public function testBadNamesWithTypeError($badName, $name) : void
    {
        $this->expectException(\TypeError::class);
        Name::fromString($badName);
        $this->fail("$name was accepted as good!");
    }

    public function badTypeNames() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [012544244, "Integer"], [null, "Null"]
        ];
    }

    /**
     * @dataProvider badNames
     */
    public function testBadNameInput($badName)
    {
        $this->expectException(\InvalidArgumentException::class);
        Name::fromString($badName);
        $this->fail("$badName failed irgendwie kp");

    }

    public function badNames() : array
    {
        return [
            ["Zahl420"], [""], ["Mr. Punkt"], ["Unter_Strich"],['<Html>'],
            ["ZuLangMerkelMerkelMerkelMerkelMerkelMerkelMerkelMerkelMerkelMerkelMerkel"]
        ];
    }
}