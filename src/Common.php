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
                return (int) $player['stack'];
            }
        }

        return 0;
    }

    public static function getOurBet(array $state): int
    {
        foreach ($state['players'] as $player) {
            if (!empty($player['hole_cards'])) {
                return (int) $player['bet'];
            }
        }

        return 0;
    }

    public static function isAllIn(array $state): bool
    {
        $stack = self::getOurStack($state);
        $currentBuyIn = (int) $state['current_buy_in'];

        return $currentBuyIn >= $stack;
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

    public static function calculateBetFromValue($value, $state): int
    {
        if ($value > 1000) {
            return Common::getOurStack($state);
        }

        if ($value > 200) {
            return max((int)$state['current_buy_in'], $state['minimum_raise'] ?? ($state['small_blind'] * 2));
        }

        if ($value > 50) {
            return $state['minimum_raise'] ?? ($state['small_blind'] * 2);
        }

        return 0;
    }
}
