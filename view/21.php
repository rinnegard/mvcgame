<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

$dice = new \viri19\Dice\Dice();
$dice->roll();

?><h1><?= $header ?></h1>

<p><?= $message ?></p>
<p><?= $dice->getFace(); ?></p>
