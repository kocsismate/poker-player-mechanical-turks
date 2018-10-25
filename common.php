<?php

class Common {
    public static function getCardsInHand(array $state): array {
        foreach ($state['players'] as $player) {
            if (!empty($player['hole_cards'])) {
                return $player['hole_cards'];
            }
        }

        return [];
    }
}
