<?php

class Preflop
{
    public function calculate(array $state): int
    {
        return (int)$state['current_buy_in'];
    }
}
