<?php
declare(strict_types=1);

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\PreflopStrategy;

class PreflopStrategyTest extends TestCase
{
    public function testTrue()
    {
        $preflop = new PreflopStrategy();

        $this->assertEquals(120, $preflop->calculate(["A", "A"], true, 100, 20));
    }
}
