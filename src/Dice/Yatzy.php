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

        // $body = renderView("layout/play21.php", $data);
        // sendResponse($body);
        return $data;
    }

    public function getPlayerSum(): int
    {
        return $this->playerSum;
    }

    public function roll(): void
    {
        $playerDiceHand->roll();
    }

    public function getEnemySum(): int
    {
        return $this->enemySum;
    }

    public function getPlayerWins(): int
    {
        return $this->playerWins;
    }

    public function getEnemyWins(): int
    {
        return $this->enemyWins;
    }

    private function enemyRoll(): void
    {
        while ($this->enemySum < 21) {
            $this->enemyDiceHand->roll();
            $this->enemySum += $this->enemyDiceHand->getLastSum();
            if ($this->enemySum > $this->playerSum) {
                break;
            }
        }
    }
}
