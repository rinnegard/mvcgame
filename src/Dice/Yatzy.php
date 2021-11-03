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

    const WINMESSAGE = "You win! Well played!";
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


        if (isset($_POST["roll"])) {
            $this->playerDiceHand->roll();
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
        $playerDiceHand->roll();
    }

    public function show()
    {
        return $this->playerDiceHand->getAllDice();
    }

    public function showSaved(): string
    {
        return json_encode($this->savedDice);
    }

}
