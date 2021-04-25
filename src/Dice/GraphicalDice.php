<?php

declare(strict_types=1);

namespace viri19\Dice;

class GraphicalDice extends Dice
{
    public function __construct() {
        parent::__construct();
        $this->sides = 6;
    }

    public function getImageClass()
    {
        return "dice-" . $this->getFace();
    }
}
