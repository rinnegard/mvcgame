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
    public array $score = [];
    public int $throws = 0;
    public int $turn = 0;

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

        if (isset($_POST["roll"])) {
            if ($this->throws == 2) {
                $data["roundEnd"] = self::WINMESSAGE;
            }
            $this->roll();
        }

        $data["player"] = $this->playerDiceHand->getLastSum();

        if (isset($_POST["save"])) {
            if ($this->throws == 2) {
                $data["roundEnd"] = self::WINMESSAGE;
            }
            unset($_POST["save"]);
            foreach ($_POST as $key => $value) {
               array_push($this->savedDice, $value);
               $this->playerDiceHand->removeDie(intval($key));
           }
        }

        if (isset($_POST["next"])) {
            $this->throws = 0;
            $this->calcScore();
            $this->playerDiceHand = new \viri19\Dice\DiceHand(5);
            $this->savedDice = [];
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
        array_push($this->score, array_sum($this->savedDice));
    }

    public function getScore(): array
    {
        return $this->score;
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
