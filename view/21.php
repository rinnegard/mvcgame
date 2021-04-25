<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

// $hand = new \viri19\Dice\DiceHand(20);
// $hand->roll();

$die = new \viri19\Dice\Dice(6);
$die->roll();

$hand = new \viri19\Dice\DiceHand(2);
$hand->roll();

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<p> One die: <?= $die->getFace(); ?></p>
<p> Hand: <?= $hand->getSum(); ?></p>
