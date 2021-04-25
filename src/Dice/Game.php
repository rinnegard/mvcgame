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

class Game
{
    public $playerDiceHand;
    public $enemyDiceHand;
    private int $playerWins = 0;
    private int $enemyWins = 0;
    private int $playerSum = 0;
    private int $enemySum = 0;
    private bool $isGameOver = False;
    private string $winner = "";

    public function __construct(int $numberOfDie = 2)
    {
        $this->playerDiceHand = new \viri19\Dice\DiceHand($numberOfDie);
        $this->enemyDiceHand = new \viri19\Dice\DiceHand($numberOfDie);
    }

    public function play(): void
    {
        $data = [
            "header" => "Play 21!",
            "message" => "21 Dice game",
        ];



        if (isset($_POST["roll"])) {
            $this->playerDiceHand->roll();
            $this->playerSum += $this->playerDiceHand->getLastSum();

            if ($this->playerSum === 21) {
                $data["winner"] = "player";
                $this->playerWins += 1;
            } elseif ($this->playerSum > 21) {
                $data["winner"] = "enemy";
                $this->enemyWins += 1;
            }
        }

        if (isset($_POST["stay"])) {
            $this->enemyRoll();

            if ($this->enemySum > 21) {
                $data["winner"] = "player";
                $this->playerWins += 1;
            } elseif ($this->enemySum === 21 || $this->enemySum > $this->playerSum) {
                $data["winner"] = "enemy";
                $this->enemyWins += 1;
            }
        }

        $data["player"] = $this->playerDiceHand->getLastSum();
        $data["enemy"] = $this->enemyDiceHand->getLastSum();

        if (isset($_POST["keepPlaying"])) {
            $this->playerSum = 0;
            $this->enemySum = 0;
            $data["player"] = 0;
            $data["enemy"] = 0;
        }





        $body = renderView("layout/21.php", $data);
        sendResponse($body);
    }

    public function getPlayerSum(): int
    {
        return $this->playerSum;
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
