<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class YatzyControllerTest extends TestCase
{

    public function testYatzyControllerClass()
    {
        $gameController = new Yatzy();
        $this->assertInstanceOf("\Mos\Controller\Yatzy", $gameController);
    }

    /**
     * @runInSeparateProcess
     */
    public function testYatzyControllerStart()
    {
        session_start();
        $gameController = new Yatzy();
        $res = $gameController->init();
        $this->assertInstanceOf("Psr\Http\Message\ResponseInterface", $res);
    }
}
