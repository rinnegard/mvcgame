<?php

declare(strict_types=1);

namespace viri19\Dice;

class DiceHand
{
    private int $numberOfDie;
    private int $lastSum = 0;
    private array $dice;

    public function __construct(int $numberOfDie = 1)
    {
        $this->numberOfDie = $numberOfDie;
        for ($i=0; $i < $numberOfDie; $i++) {
            $this->dice[$i] = new Dice(6);
        }
    }

    public function roll(): void
    {
        $this->lastSum = 0;
        for ($i=0; $i < $this->numberOfDie; $i++) {
            $this->dice[$i]->roll();
            $this->lastSum += $this->dice[$i]->getFace();
        }
    }

    public function getLastSum(): int
    {
        return $this->lastSum;
    }

    public function getNumOfDie(): int
    {
        return $this->numberOfDie;
    }
}
