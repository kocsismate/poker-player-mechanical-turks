<?php

require_once '../vendor/autoload.php';
require_once '../preflop.php';

class PreflopTest extends \PHPUnit\Framework\TestCase
{
    public function testTrue()
    {
        $preflop = new Preflop();

        $state = [
        ];

        $this->assertTrue(true);
    }
}
