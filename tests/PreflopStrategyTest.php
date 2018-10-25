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

        $this->assertEquals(100, $preflop->calculate(["A", "A"], true, 100, 20));
    }

    public function testPairOfTwo()
    {
        $preflop = new PreflopStrategy();

        $this->assertEquals(0, $preflop->calculate(["2", "2"], false, 100, 20));
    }

    public function testTwoSeven()
    {
        $preflop = new PreflopStrategy();

        $this->assertEquals(0, $preflop->calculate(["2", "7"], false, 100, 20));
    }
}
