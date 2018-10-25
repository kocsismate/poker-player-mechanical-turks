<?php

require_once "common.php";

class Postflop
{
    public function calculate(array $state): int
    {
        return (int)$state['current_buy_in'];
    }

    private function getHandValue(): int
    {

    }
}
