<?php

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<form  action="" method="post">
    <p>I hope you know the rules!</p>
    <input type="submit" name="submit" value="Begin!">
</form>
