<?php

declare(strict_types=1);

namespace viri19\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the Dice Class.
 */
class GameTest extends TestCase
{
    public function testGameClass()
    {
        $game = new Game();
        $this->assertInstanceOf("viri19\Dice\Game", $game);
    }

    public function testGamePlayRoll()
    {
        $game = new Game();
        $game->play("roll");
        $this->assertGreaterThan(0, $game->getPlayerSum());
    }

    public function testGamePlayRollLose()
    {
        $game = new Game();
        for ($i=0; $i < 10; $i++) {
            $data = $game->play("roll");
        }

        $this->assertArrayHasKey("winner", $data);

    }

    public function testGameStayLose()
    {
        $game = new Game(1);
        $game->play("roll");
        $game->play("stay");

        $this->assertEquals(1, $game->getEnemyWins());
        $this->assertEquals(0, $game->getPlayerWins());
    }

    public function testGameStayWin()
    {
        $game = new Game(2);
        for ($i=0; $i < 20; $i++) {
            $game->play("stay");
        }
        $this->assertGreaterThan(0, $game->getPlayerWins());
    }

    public function testGameKeepPlaying()
    {
        $game = new Game();
        $game->play("roll");
        $game->play("stay");
        $this->assertGreaterThan(0, $game->getPlayerSum());
        $this->assertGreaterThan(0, $game->getEnemySum());
        $game->play("keepPlaying");
        $this->assertEquals(0, $game->getPlayerSum());
        $this->assertEquals(0, $game->getEnemySum());
    }

    public function testGameRestart()
    {
        $game = new Game();
        $game->play("stay");
        $this->assertGreaterThan(0, $game->getEnemyWins());
        $game->play("restart");
        $this->assertEquals(0, $game->getEnemyWins());
    }

}
