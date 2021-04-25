<?php

declare(strict_types=1);

namespace viri19\DiceHand;


/**
 * Class Router.
 */
class DiceHand
{
    private int $diceAmount;
    private int $sum;

    public function __construct($diceAmount)
    {
        $this->$diceAmount = $diceAmount;
    }

    public function roll(): void
    {

    }

    public function getSum(): int
    {
        return $this->sum;
    }
}
