<?php

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

 $_SESSION["yatzy"]->play();
 $die1 = $_SESSION["yatzy"]->show();

?><h1><?= $header ?></h1>

<p><?= $message ?></p>
<?php foreach ($die1 as $key => $value): ?>
    <p><?= $value->getFace(); ?></p>
<?php endforeach; ?>

<form  action="" method="post">
    <p>I hope you know the rules!</p>
    <input type="submit" name="submit" value="Begin!">
</form>
