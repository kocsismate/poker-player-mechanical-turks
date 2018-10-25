<?php

require_once '../vendor/autoload.php';
require_once '../postflop.php';

class PostlopTest extends \PHPUnit\Framework\TestCase
{
    private $state = [
        "players" => [
            [
                "name" => "Player 1",
                "stack" => 1000,
                "status" => "active",
                "bet" => 0,
                "hole_cards" => [
                    [
                        "rank" => 'K',
                        "suit" => 'spades',
                    ],
                    [
                        "rank" => 'K',
                        "suit" => 'hearts',
                    ],
                ],
                "version" => "Version name 1",
                "id" => 0,
            ],
            [
                "name" => "Player 2",
                "stack" => 1000,
                "status" => "active",
                "bet" => 0,
                "version" => "Version name 2",
                "id" => 1,
            ],
        ],
        "tournament_id" => "550d1d68cd7bd10003000003",
        "game_id" => "550da1cb2d909006e90004b1",
        "round" => 0,
        "bet_index" => 0,
        "small_blind" => 10,
        "orbits" => 0,
        "in_action" => 0,
        "dealer" => 0,
        "community_cards" => [
            [
                "rank" => '2',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
        ],
        "current_buy_in" => 0,
        "pot" => 0,
    ];

    public function testTwoPairsCall()
    {
        $state = $this->state;
        $state['community_cards'] = [
            [
                "rank" => '2',
                "suit" => 'hearts',
            ],
            [
                "rank" => 'K',
                "suit" => 'diamonds',
            ],
            [
                "rank" => 'A',
                "suit" => 'spades',
            ],
        ];
        $state['players'][0]['hole_cards'] = [
            [
                "rank" => 'K',
                "suit" => 'hearts',
            ],
            [
                "rank" => 'A',
                "suit" => 'hearts',
            ],
        ];

        $strategy = new Postflop();
        $bet = $strategy->calculate($state);

        $this->assertEquals(20, $bet);
    }

    public function testHighCardCall()
    {
        $state = $this->state;
        $state['community_cards'] = [
            [
                "rank" => '2',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => '8',
                "suit" => 'diamonds',
            ],
        ];
        $state['players'][0]['hole_cards'] = [
            [
                "rank" => 'K',
                "suit" => 'spades',
            ],
            [
                "rank" => 'A',
                "suit" => 'hearts',
            ],
        ];

        $strategy = new Postflop();
        $bet = $strategy->calculate($state);

        $this->assertEquals(0, $bet);
    }

    public function testHasPair1()
    {
        $cards = [
            [
                "rank" => '2',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '7',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertTrue($strategy->hasPair($cards));
    }

    public function testHasPair2()
    {
        $cards = [
            [
                "rank" => '2',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '6',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertFalse($strategy->hasPair($cards));
    }

    public function testHasPair3()
    {
        $cards = [
            [
                "rank" => '2',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '6',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '8',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '9',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertFalse($strategy->hasPair($cards));
    }

    public function testHasPair4()
    {
        $cards = [
            [
                "rank" => '8',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '6',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '8',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '9',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertTrue($strategy->hasPair($cards));
    }


    public function testHasTwoPair1()
    {
        $cards = [
            [
                "rank" => '3',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '7',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertTrue($strategy->hasTwoPairs($cards));
    }

    public function testHasTwoPair2()
    {
        $cards = [
            [
                "rank" => '2',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '7',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertFalse($strategy->hasTwoPairs($cards));
    }

    public function testHasTwoPair3()
    {
        $cards = [
            [
                "rank" => '7',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '7',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertFalse($strategy->hasTwoPairs($cards));
    }

    public function testHasTwoPair4()
    {
        $cards = [
            [
                "rank" => '7',
                "suit" => 'spades',
            ],
            [
                "rank" => '7',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '6',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '7',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '9',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertFalse($strategy->hasTwoPairs($cards));
    }

    public function testHasTwoPair5()
    {
        $cards = [
            [
                "rank" => '8',
                "suit" => 'spades',
            ],
            [
                "rank" => '9',
                "suit" => 'clubs',
            ],
            [
                "rank" => 'Q',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '3',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '6',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '8',
                "suit" => 'diamonds',
            ],
            [
                "rank" => '9',
                "suit" => 'diamonds',
            ],
        ];
        $strategy = new Postflop();
        $this->assertTrue($strategy->hasTwoPairs($cards));
    }
}
