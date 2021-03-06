<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

class GameController
{
    public function start(): ResponseInterface
    {
        $data = [
            "header" => "Dice 21!",
            "message" => "Try to get to 21! But don't go over!",
            "action" => url("/game/start21"),
            "output" => $_SESSION["output"] ?? null,
        ];

        $body = renderView("layout/start21.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function init(): ResponseInterface
    {

        if (!isset($_SESSION["game"])) {
            $_SESSION["game"] = new \viri19\Dice\Game();
        }
        $data = $_SESSION["game"]->play();

        $body = renderView("layout/play21.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
