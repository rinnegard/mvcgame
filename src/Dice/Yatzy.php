<?php

declare(strict_types=1);

namespace viri19\Dice;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

class Yatzy
{
    public $playerDiceHand;
    public array $savedDice = [];
    public int $throws = 0;

    const WINMESSAGE = "Time for the next round";
    const LOSEMESSAGE = "You lost! Better luck next time!";

    public function __construct(int $numberOfDie = 5)
    {
        $this->playerDiceHand = new \viri19\Dice\DiceHand($numberOfDie);
    }

    public function play(): array
    {
        $data = [
            "header" => "Play Yatzy!!",
            "message" => "Good luck!",
        ];

        if ($this->throws == 2) {
            $data["roundEnd"] = self::WINMESSAGE;
        }


        if (isset($_POST["roll"])) {
            $this->roll();
        }

        $data["player"] = $this->playerDiceHand->getLastSum();

        if (isset($_POST["save"])) {
            unset($_POST["save"]);
            foreach ($_POST as $key => $value) {
               array_push($this->savedDice, $value);
               $this->playerDiceHand->removeDie(intval($key));
           }
        }

        if (isset($_POST["restart"])) {
            $this->playerWins = 0;
            $this->enemyWins = 0;
        }

        return $data;
    }


    public function roll(): void
    {
        $this->throws++;
        $this->playerDiceHand->roll();
    }

    public function calcScore(): void
    {
        
    }

    public function show()
    {
        return $this->playerDiceHand->getAllDice();
    }

    public function showSaved(): string
    {
        return json_encode($this->savedDice);
    }

    public function getTurn(): int
    {
        return $this->throws;
    }


}
