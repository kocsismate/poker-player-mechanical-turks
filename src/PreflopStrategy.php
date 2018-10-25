<?php
declare(strict_types=1);

namespace Poker;

class PreflopStrategy
{
    private static $percentages = [
        "AA" => 8,
        "KK" => 8,
        "QQ" => 8,
        "JJ" => 7,
        "1010" => 7,
        "99" => 7,
        "88" => 6,
        "77" => 6,
        "66" => 6,
        "55" => 6,
        "44" => 5,
        "33" => 5,
        "22" => 5,
        "AK" => 6,
        "AQ" => 6,
        "AJ" => 6,
        "A10" => 6,
        "A9" => 6,
        "A8" => 6,
        "A7" => 6,
        "A6" => 6,
        "A5" => 6,
        "A4" => 6,
        "A3" => 6,
        "A2" => 5,
        "KQ" => 6,
        "KJ" => 6,
        "K10" => 6,
        "K9" => 6,
        "K8" => 6,
        "K7" => 5,
        "K6" => 5,
        "K5" => 5,
        "K4" => 5,
        "K3" => 5,
        "K2" => 5,
        "QJ" => 6,
        "Q10" => 6,
        "Q9" => 5,
        "Q8" => 5,
        "Q7" => 5,
        "Q6" => 5,
        "Q5" => 5,
        "Q4" => 5,
        "Q3" => 5,
        "Q2" => 5,
        "J10" => 5,
        "J9" => 5,
        "J8" => 5,
        "J7" => 5,
        "J6" => 5,
        "J5" => 5,
        "J4" => 5,
        "J3" => 5,
        "J2" => 5,
        "109" => 5,
        "108" => 5,
        "107" => 5,
        "106" => 5,
        "98" => 5,
        "97" => 5,
        "96" => 5,
        "87" => 5,
    ];

    public function calculate(array $cardNumbers, bool $isAllIn, int $currentBuyIn, int $minimumRaise): int
    {
        $percentage = $this->getPercentage($cardNumbers);

        // Fold if percentage is lame
        if ($percentage === 0) {
            return 0;
        }

        // Fold if it is all-in and percentage is <= 7
        if ($isAllIn && $percentage <= 7) {
            return 0;
        }

        // Raise if percentage is >= 8
        if ($percentage >= 8) {
            //return $currentBuyIn + $minimumRaise;
        }

        return $currentBuyIn;
    }

    private function getPercentage(array $cardNumbers): int
    {
        if (isset(self::$percentages[$cardNumbers[0] . $cardNumbers[1]])) {
            return self::$percentages[$cardNumbers[0] . $cardNumbers[1]];
        }

        if (isset(self::$percentages[$cardNumbers[1] . $cardNumbers[0]])) {
            return self::$percentages[$cardNumbers[1] . $cardNumbers[0]];
        }

        return 0;
    }
}
