<?php

require_once "common.php";

class Postflop
{
    public function calculate(array $state): int
    {
        return (int)$state['current_buy_in'];
    }

    private function getHandValue($state): int
    {

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

    }

    private function hasFourOfAKind(array $cards): bool
    {

    }

    private function hasFull(array $cards): bool
    {

    }

    private function hasFlush(array $cards): bool
    {

    }

    private function hasStraight(array $cards): bool
    {

    }

    private function hasThreeOfAKind(array $cards): bool
    {

    }

    private function hasTwoPairs(array $cards): bool
    {

    }

    private function hasPair(array $cards): bool
    {

    }

}
