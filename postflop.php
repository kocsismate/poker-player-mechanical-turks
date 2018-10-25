<?php

require_once "common.php";

class Postflop
{
    public function calculate(array $state): int
    {
        $value = $this->getHandValue($state);
        if ($value > 1000) {
            return Common::getOurStack($state);
        } elseif ($value > 200) {
            return max((int)$state['current_buy_in'], $state['minimum_raise']);
        } elseif ($value > 50) {
            return $state['minimum_raise'];
        }
        return 0;
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
        return Common::getCardsInHand($state) + $this->getCommonCards($state);
    }

    private function getCommonCards(array $state): array
    {
        return $state['community_cards'];
    }

    private function hasStraightFlush(array $cards): bool
    {
        return false;
    }

    private function hasFourOfAKind(array $cards): bool
    {
        return false;
    }

    private function hasFull(array $cards): bool
    {
        return false;
    }

    private function hasFlush(array $cards): bool
    {
        return false;
    }

    private function hasStraight(array $cards): bool
    {
        return false;
    }

    private function hasThreeOfAKind(array $cards): bool
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

    private function hasTwoPairs(array $cards): bool
    {
        return false;
    }

    private function hasPair(array $cards): bool
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
