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

<p>Latest player roll: <?= $player ?></p>

<p> Player total: <?= $_SESSION["game"]->getPlayerSum(); ?></p>

<p> Enemy total: <?= $_SESSION["game"]->getEnemySum(); ?></p>

<p>Player wins: <?= $_SESSION["game"]->getPlayerWins(); ?> | Enemy wins: <?= $_SESSION["game"]->getEnemyWins(); ?></p>


<?php if (isset($_SESSION["game"]) && !isset($winner)): ?>
    <form  action="" method="post">
        <input type="submit" name="roll" value="roll">
        <input type="submit" name="stay" value="stay">
    </form>


<?php endif; ?>

<?php if (isset($winner)): ?>
    <p><?= $winner ?></p>
    <form  action="play21" method="post">
        <input type="submit" name="keepPlaying" value="Keep Playing">
        <input type="submit" name="restart" value="Restart">
    </form>
<?php endif; ?>
