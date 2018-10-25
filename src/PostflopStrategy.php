<?php

namespace Poker;

class PostflopStrategy
{
    public function calculate(array $state): int
    {
        $value = $this->getHandValue($state);
        $bet = Common::calculateBetFromValue($value, $state);
        error_log("Value: $value Bet: $bet Cards: " . print_r($this->getAllCards($state), true));
        return $bet;
    }

    private function getHandValue($state): int
    {
        $cards = $this->getAllCards($state);

        if ($this->hasStraightFlush($cards)) {
            return 1000000;
        }

        if ($this->hasFourOfAKind($cards)) {
            return 100000;
        }

        if ($this->hasFull($cards)) {
            return 10000;
        }

        if ($this->hasFlush($cards)) {
            return 1000;
        }

        if ($this->hasStraight($cards)) {
            return 500;
        }

        if ($this->hasThreeOfAKind($cards)) {
            return 300;
        }

        if ($this->hasTwoPairs($cards)) {
            return 200;
        }

        if ($this->hasTwoPairs($cards)) {
            return 100;
        }

        if ($this->hasPair($cards)) {
            return 30;
        }

        $card = Common::getHighestCard($state);
        return Common::getCardValue($card);
    }

    private function getAllCards($state): array
    {
        return array_merge(Common::getCardsInHand($state), $this->getCommonCards($state));
    }

    private function getCommonCards(array $state): array
    {
        return $state['community_cards'];
    }

    public function hasStraightFlush(array $cards): bool
    {
        usort($cards, function ($a, $b) {
            return Common::getCardValue($a['rank']) <=> Common::getCardValue($b['rank']);
        });

        $neighbours = 0;
        $lastValue = Common::getCardValue($cards[0]['rank']);
        $color = $cards[0]['suit'];
        foreach ($cards as $card) {
            if (Common::getCardValue($card['rank']) == $lastValue + 1) {
                $neighbours += 1;
                if ($color !== $card['suit']) {
                    $neighbours = 0;
                }
            } else {
                $neighbours = 0;
                $color = $card['suit'];
            }
            $lastValue = Common::getCardValue($card['rank']);

            if ($neighbours > 3) {
                return true;
            }
        }

        return false;
    }

    public function hasFourOfAKind(array $cards): bool
    {
        $nrOfCards = sizeof($cards);
        for($i = 0; $i < $nrOfCards-3; $i++) {
            for($j = $i+1; $j < $nrOfCards-2; $j++) {
                for($k = $j+1; $k < $nrOfCards-1; $k++) {
                    for($l = $k+1; $l < $nrOfCards; $l++) {
                        if($cards[$i]["rank"] == $cards[$j]["rank"] && $cards[$i]["rank"] == $cards[$k]["rank"] && $cards[$i]["rank"] == $cards[$l]["rank"])
                            return true;
                    }
                }
            }
        }
        return false;
    }

    public function hasFull(array $cards): bool
    {
        return $this->hasTwoPairs($cards) && $this->hasThreeOfAKind($cards);
    }

    public function hasFlush(array $cards): bool
    {
        $colors = [];
        foreach ($cards as $card) {
            if (!isset($colors[$card['suit']])) {
                $colors[$card['suit']] = 1;
            } else {
                $colors[$card['suit']] += 1;
            }
        }

        foreach ($colors as $numbers) {
            if ($numbers > 4) {
                return true;
            }
        }
        return false;
    }

    public function hasStraight(array $cards): bool
    {
        usort($cards, function ($a, $b) {
            return Common::getCardValue($a['rank']) <=> Common::getCardValue($b['rank']);
        });

        $neighbours = 0;
        $lastValue = Common::getCardValue($cards[0]['rank']);
        foreach ($cards as $card) {
            if (Common::getCardValue($card['rank']) == $lastValue + 1) {
                $neighbours += 1;
            } else {
                $neighbours = 0;
            }
            $lastValue = Common::getCardValue($card['rank']);

            if ($neighbours > 3) {
                return true;
            }
        }

        return false;
    }

    public function hasThreeOfAKind(array $cards): bool
    {
        $nrOfCards = sizeof($cards);
        for($i = 0; $i < $nrOfCards-2; $i++) {
            for($j = $i+1; $j < $nrOfCards-1; $j++) {
                for($k = $j+1; $k < $nrOfCards; $k++) {
                    if($cards[$i]["rank"] == $cards[$j]["rank"] && $cards[$i]["rank"] == $cards[$k]["rank"])
                        return true;
                }
            }
        }
        return false;
    }

    public function hasTwoPairs(array $cards): bool
    {
        $cardNumbers = [];
        foreach ($cards as $card) {
            $cardNumbers[] = $card["rank"];
        }
        sort($cardNumbers);

        $nrOfCards = sizeof($cardNumbers);
        for($i = 0; $i < $nrOfCards-3; $i++) {
            for($j = $i+1; $j < $nrOfCards-2; $j++) {
                if($cardNumbers[$i] == $cardNumbers[$j]) { //found one pair
                    for($k = $j+1; $k < $nrOfCards-1; $k++) {
                        for($l = $k+1; $l < $nrOfCards; $l++) {
                            if($cardNumbers[$k] == $cardNumbers[$l])
                                return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function hasPair(array $cards): bool
    {
        $nrOfCards = sizeof($cards);
        for($i = 0; $i < $nrOfCards-1; $i++) {
            for($j = $i+1; $j < $nrOfCards; $j++) {
                if($cards[$i]["rank"] == $cards[$j]["rank"])
                    return true;
            }
        }
        return false;
    }

}
