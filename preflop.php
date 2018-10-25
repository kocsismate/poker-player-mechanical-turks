<?php

require_once "common.php";

class Preflop
{
    private static $percentages = [
        "AA" => 8,
        "KK" => 8,
        "QQ" => 8,
        "JJ" => 7,
        "1010" => 7,
        "99" => 7,
        "88" => 6,
    ];

    public function calculate(array $state): int
    {
        $cardNumbers = Common::getCardNumbersInHand($state);

        if (isset(self::$percentages[$cardNumbers[0] . $cardNumbers[1]])) {
        }

        return (int)$state['current_buy_in'];
    }
}
