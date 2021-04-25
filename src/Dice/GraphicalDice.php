<?php

declare(strict_types=1);

namespace viri19\Dice;

class GraphicalDice extends Dice
{

    public function __construct($sides = 6) {
        parent::__construct(6);
    }

    public function getImageClass()
    {
        return "dice-" . $this->getFace();
    }
}
