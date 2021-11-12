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
    // public function start(): ResponseInterface
    // {
    //     $data = [
    //         "header" => "Yatzy!!",
    //         "message" => "Let's play!",
    //         "action" => url("/yatzy"),
    //         "output" => $_SESSION["output"] ?? null,
    //     ];
    //
    //     $body = renderView("layout/yatzy.php", $data);
    //
    //     $psr17Factory = new Psr17Factory();
    //     return $psr17Factory
    //         ->createResponse(200)
    //         ->withBody($psr17Factory->createStream($body));
    // }

    public function init(): ResponseInterface
    {
        $data = [
            "header" => "Yatzy!!",
            "message" => "Let's play!",
            "action" => url("/yatzy"),
            "output" => $_SESSION["output"] ?? null,
        ];

        if (!isset($_SESSION["yatzy"])) {
            $_SESSION["yatzy"] = new \viri19\Dice\Yatzy();
        }
        $data = $_SESSION["yatzy"]->play();

        $body = renderView("layout/yatzy.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
