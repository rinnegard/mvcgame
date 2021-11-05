<?php

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;


$die1 = $_SESSION["yatzy"]->show();
$savedDie = $_SESSION["yatzy"]->showSaved();
$turn = $_SESSION["yatzy"]->getTurn();
$score = $_SESSION["yatzy"]->getScore();

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<?php
var_dump($_POST);
?>

<p>Select the dice you want to save.</p>
<p>
<form  action="" method="post">
<?php foreach ($die1 as $key => $value): ?>
    <input type="checkbox" name="<?= $key ?>" value="<?= $value->getFace() ?>"><?= $value->getFace(); ?></input>
<?php endforeach; ?>
    <input type="submit" name="save" value="Save">
</form>
</p>

<?php if (!isset($gameover)) : ?>

    <p><?= $savedDie ?></p>
    <p><?= $turn ?></p>

    <?php if (!isset($roundEnd)) : ?>
    <form  action="" method="post">
        <input type="submit" name="roll" value="Roll!">
    </form>
    <?php endif; ?>






    <?php if (isset($roundEnd)) : ?>
        <p><?= $roundEnd ?></p>
        <form  action="" method="post">
            <input type="submit" name="next" value="next">
        </form>
    <?php endif; ?>

    <?php if (isset($gameover)) : ?>
        <p><?= $gameover ?></p>
    <?php endif; ?>

<?php endif; ?>

<?php var_dump($score) ?>
