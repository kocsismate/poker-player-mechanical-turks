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
        return false;
    }

    private function hasTwoPairs(array $cards): bool
    {
        return false;
    }

    private function hasPair(array $cards): bool
    {
        return false;
    }

}
