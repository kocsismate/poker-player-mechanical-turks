<?php

require_once "preflop.php";
require_once "postflop.php";

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest(array $game_state)
    {
        return $game_state['current_buy_in'];

        if (empty($game_state["community_cards"])) {
            $preflop = new Preflop();

            return $preflop->calculate($game_state);
        }

        $postflop = new Preflop();

        return $postflop->calculate($game_state);
    }

    public function showdown(array $game_state)
    {
    }
}
