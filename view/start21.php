<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

var_dump($_POST);

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<form  action="play21" method="post">
    <p>How many dice do you want per throw?</p>
    <input type="radio" name="handsize" value=1>
    <label for="1">1</label>
    <input type="radio" name="handsize" value=2>
    <label for="2">2</label>
    <input type="submit" name="submit" value="Submit">
</form>
