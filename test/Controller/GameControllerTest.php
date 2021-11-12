<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class GameControllerTest extends TestCase
{

    public function testCreateGameControllerClass()
    {
        $gameController = new GameController();
        $this->assertInstanceOf("\Mos\Controller\GameController", $gameController);
    }

    public function testGameControllerStart()
    {
        $gameController = new GameController();
        $res = $gameController->start();
        $this->assertInstanceOf("Psr\Http\Message\ResponseInterface", $res);
    }

    /**
     * @runInSeparateProcess
     */
    public function testGameControllerInit()
    {
        session_start();
        $gameController = new GameController();
        $res = $gameController->init();
        $this->assertInstanceOf("Psr\Http\Message\ResponseInterface", $res);
    }
}
