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

class Yatzy
{
    public function start(): ResponseInterface
    {
        $data = [
            "header" => "Yatzy!!",
            "message" => "Let's play!",
            "action" => url("/yatzy"),
            "output" => $_SESSION["output"] ?? null,
        ];

        $body = renderView("layout/yatzy.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function init(): ResponseInterface
    {
        // $data = [
        //     "header" => "Play 21!",
        //     "message" => "Try to get as close to 21 as you can. But remember to not go over!",
        //     "action" => url("/game/play21"),
        //     "output" => $_SESSION["output"] ?? null,
        // ];

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
