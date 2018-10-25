<?php

require_once "common.php";

class Preflop
{
    private static $percentage = [
        "AA" => 8,
        "KK" => 8,
        "QQ" => 8,
        "JJ" => 7,
        "JJ" => 7,
        "1010" => 7,
        "99" => 7,
        "99" => 7,
        "88" => 6,
    ];

    public function calculate(array $state): int
    {
        return (int)$state['current_buy_in'];
    }
}
