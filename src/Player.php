<?php
declare(strict_types=1);

namespace Poker;

class Player
{
    const VERSION = "Clever Player";

    public function betRequest(array $game_state): int
    {
        if (empty($game_state["community_cards"])) {
            $strategy = new PreflopStrategy();

            return $strategy->calculate(
                \Common::getCardNumbersInHand($game_state),
                Common::isAllIn($game_state),
                $game_state["current_buy_in"],
                $game_state["minimum_raise"]
            );
        }

        $strategy = new PostflopStrategy();

        return $strategy->calculate($game_state);
    }

    public function showdown(array $game_state)
    {
    }
}
