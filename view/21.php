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
    <form  action="" method="post">
        <input type="submit" name="keepPlaying" value="Keep Playing">
        <input type="submit" name="restart" value="Restart">
    </form>
<?php endif; ?>



    <!-- <form  action="" method="post">
        <p>How many dice?</p>
        <input type="radio" name="count" value="1">
        <label for="1">1</label>
        <input type="radio" name="count" value="2">
        <label for="2">2</label>
        <input type="submit" name="submit" value="Submit">
    </form> -->
