<?php

class Common
{
    public static function getCardsInHand(array $state): array
    {
        foreach ($state['players'] as $player) {
            if (!empty($player['hole_cards'])) {
                return $player['hole_cards'];
            }
        }

        return [];
    }

    public static function isSameColor(array $cards): bool
    {
        $commonColor = $cards[0]["suit"];
        foreach ($cards as $card) {
            if ($card["suit"] != $commonColor)
                return false;
        }
        return true;
    }

    public static function getCardNumbersInHand(array $state): array
    {
        $cards = self::getCardsInHand($state);

        $cardNumbers = [];
        foreach ($cards as $card) {
            $cardNumbers[] = $card["rank"];
        }

        return $cardNumbers;
    }
}
