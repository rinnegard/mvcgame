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

    const WINMESSAGE = "You win! Well played!";
    const LOSEMESSAGE = "You lost! Better luck next time!";

    public function __construct(int $numberOfDie = 2)
    {
        $this->playerDiceHand = new \viri19\Dice\DiceHand($numberOfDie);
        $this->enemyDiceHand = new \viri19\Dice\DiceHand($numberOfDie);
    }

    public function play(): void
    {
        $data = [
            "header" => "Play 21!",
            "message" => "Try to get as close to 21 as you can. But remember to not go over!",
        ];

        if (isset($_POST["roll"])) {
            $this->playerDiceHand->roll();
            $this->playerSum += $this->playerDiceHand->getLastSum();

            if ($this->playerSum === 21) {
                $data["winner"] = self::WINMESSAGE;
                $this->playerWins += 1;
            } elseif ($this->playerSum > 21) {
                $data["winner"] = self::LOSEMESSAGE;
                $this->enemyWins += 1;
            }
        }

        if (isset($_POST["stay"])) {
            $this->enemyRoll();

            if ($this->enemySum > 21) {
                $data["winner"] = self::WINMESSAGE;
                $this->playerWins += 1;
            } elseif ($this->enemySum === 21 || $this->enemySum > $this->playerSum) {
                $data["winner"] = self::LOSEMESSAGE;
                $this->enemyWins += 1;
            }
        }

        $data["player"] = $this->playerDiceHand->getLastSum();
        $data["enemy"] = $this->enemyDiceHand->getLastSum();

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

        $body = renderView("layout/play21.php", $data);
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
