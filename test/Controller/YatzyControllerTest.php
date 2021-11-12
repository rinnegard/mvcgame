<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class YatzyControllerTest extends TestCase
{

    public function testCreateYatzyControllerClass()
    {
        $gameController = new Yatzy();
        $this->assertInstanceOf("\Mos\Controller\Yatzy", $gameController);
    }

    public function testCreateYatzyControllerStart()
    {
        $gameController = new GameController();
        $res = $gameController->start();
        $this->assertInstanceOf("Psr\Http\Message\ResponseInterface", $res);
    }

}
