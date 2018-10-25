<?php

require_once "preflop.php";
require_once "postflop.php";

class Player
{
    const VERSION = "Clever Player";

    public function betRequest(array $game_state)
    {
        if (empty($game_state["community_cards"])) {
            $strategy = new Preflop();
        } else {
            $strategy = new Postflop();
        }

        return $strategy->calculate($game_state);
    }

    public function showdown(array $game_state)
    {
    }
}
