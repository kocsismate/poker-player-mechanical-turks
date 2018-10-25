<?php
declare(strict_types=1);

namespace Poker;

class Common
{
    public static function getCardValue(string $card): int
    {
        switch ($card) {
            case 'A':
                return 14;
            case 'K':
                return 13;
            case 'Q':
                return 12;
            case 'J':
                return 11;
            default:
                return (int)$card;
        }
    }

    public static function getCardsInHand(array $state): array
    {
        foreach ($state['players'] as $player) {
            if (!empty($player['hole_cards'])) {
                return $player['hole_cards'];
            }
        }

        return [];
    }

    public static function getOurStack(array $state): int
    {
        foreach ($state['players'] as $player) {
            if (!empty($player['hole_cards'])) {
                return (int)$player['stack'];
            }
        }

        return 0;
    }

    public static function isAllIn(array $state): int
    {
        $stack = self::getOurStack($state);
        $currentBuyIn = (int)$state['current_buy_in'];

        return $stack === $currentBuyIn;
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

    public static function getHighestCard(array $state): string
    {
        $cards = self::getCardNumbersInHand($state);
        $highest = $cards[0];
        foreach ($cards as $card) {
            if (self::getCardValue($highest) < self::getCardValue($card)) {
                $highest = $card;
            }
        }
        return $highest;
    }
}
