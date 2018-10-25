<?php

class Postflop
{
    public function calculate(array $state): int
    {
        return (int)$state['current_buy_in'];
    }
}
