<?php

declare(strict_types=1);

namespace Mos\Router;

use function Mos\Functions\{
    destroySession,
    //redirectTo,
    renderView,
    renderTwigView,
    //sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            //sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            //sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            //redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            //sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            //sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            //sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/form/view") {
            $data = [
                "header" => "Form",
                "message" => "Press submit to send the message to the result page.",
                "action" => url("/form/process"),
                "output" => $_SESSION["output"] ?? null,
            ];
            $body = renderView("layout/form.php", $data);
            //sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/form/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            //redirectTo(url("/form/view"));
            return;
        } else if ($method === "GET" && $path === "/game/play21") {
            if (!isset($_SESSION["game"])) {
                $_SESSION["game"] = new \viri19\Dice\Game();
            }
            $_SESSION["game"]->play();
            return;
        } else if ($method === "POST" && $path === "/game/play21") {
            if (!isset($_SESSION["game"])) {
                $_SESSION["game"] = new \viri19\Dice\Game((int)$_POST["handsize"]);
            }
            $_SESSION["game"]->play();
            return;
        } else if ($method === "GET" && $path === "/game/start21") {
            if (isset($_SESSION["game"])) {
                $_SESSION["game"] = null;
            }
            $data = [
                "header" => "Dice 21!",
                "message" => "Try to get to 21! But don't go over!",
            ];
            $body = renderView("layout/start21.php", $data);
            //sendResponse($body);
            return;
        }

        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        //sendResponse($body, 404);
    }
}
