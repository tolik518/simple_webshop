<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\State
 */
class StateTest extends TestCase
{
    /**
     * @dataProvider badStates
     */
    public function testBadPhonenumbers($badState) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        State::fromString($badState);
        $this->fail("$badState was accepted as good!");
    }

    public function badStates() : array
    {
        return [
            ['03011'], ['Aa'], ["Berlin1337"]
        ];
    }

    /**
     * @dataProvider badTypeStates
     */
    public function testBadStatesWithTypeError($badState, $badStateName) : void
    {
        $this->expectException(\TypeError::class);
        State::fromString($badState);
        $this->fail("$badStateName was accepted as good!");
    }

    public function badTypeStates() : array
    {
        return [
            [[], "Array"], [false, "Bool"], [167976431, "Number"]
        ];
    }

    /**
     * @dataProvider goodStates
     */
    public function testGoodStates($goodStates) : void
    {
        State::fromString($goodStates);
        $this->addToAssertionCount(1);
    }

    public function goodStates() : array
    {
        return [
            ['Mecklenburg-Vorpommern'], ['Uri'], ['Niederösterreich']
        ];
    }
}
