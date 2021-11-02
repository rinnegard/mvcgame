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

        $this->playerDiceHand->roll();

        if (isset($_POST["roll"])) {
            $this->playerDiceHand->roll();
        }

        $data["player"] = $this->playerDiceHand->getLastSum();

        if (isset($_POST["keepPlaying"]) || isset($_POST["restart"])) {
            $this->playerSum = 0;
            $this->enemySum = 0;
            $data["player"] = 0;
            $data["enemy"] = 0;
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

}
