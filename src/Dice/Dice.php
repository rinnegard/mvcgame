<?php

declare(strict_types=1);

namespace viri19\Dice;


/**
 * Class Router.
 */
class Dice
{
    private int $face = 0;
    private int $sides;

    public function __construct($sides = 6)
    {
        $this->sides = $sides;
    }

    public function roll(): void
    {
        $this->face = rand(1, $this->sides);
    }

    public function getFace(): int
    {
        return $this->face;
    }
}
