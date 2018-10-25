<?php

class Player
{
    const VERSION = "Default PHP folding player";

    public function betRequest($game_state)
    {
        return $game_state['current_buy_in'];
    }

    public function showdown($game_state)
    {
    }
}
