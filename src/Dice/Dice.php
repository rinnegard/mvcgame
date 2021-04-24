<?php

declare(strict_types=1);

namespace viri19\Router;


/**
 * Class Router.
 */
class Dice
{
    private int $face;
    private int $sides = 6;

    public function __construct($sides)
    {
        $this->sides = $sides;
    }

    public function roll(): void
    {
        $this->face = rand(1, $this->sides);
    }

    public function getFace(): void
    {
        return $this->face;
    }
}
