<?php
declare(strict_types=1);

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\PreflopStrategy;

class PreflopStrategyTest extends TestCase
{
    public function testAcePair()
    {
        $preflop = new PreflopStrategy();

        $this->assertEquals(120, $preflop->calculate(["A", "A"], false, true, 0, 100, 20));
    }

    public function testPairOfTwo()
    {
        $preflop = new PreflopStrategy();

        $this->assertEquals(100, $preflop->calculate(["2", "2"], false, false, 0, 100, 20));
    }

    public function testTwoSeven()
    {
        $preflop = new PreflopStrategy();

        $this->assertEquals(0, $preflop->calculate(["2", "7"], false, false, 0, 100, 20));
    }

    public function testJumboThree()
    {
        $preflop = new PreflopStrategy();

        $this->assertEquals(0, $preflop->calculate(["J", "3"], false, true, 0, 100, 20));
    }

    public function testSixFour()
    {
        $preflop = new PreflopStrategy();

        $this->assertEquals(100, $preflop->calculate(["6", "4"], true, false, 0, 100, 20));
    }
}
