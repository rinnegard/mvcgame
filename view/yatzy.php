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
<?php endif; ?>
<table>
    <tr>
        <th>Player</th>
    </tr>
    <tr>
        <td>Ones</td>
        <?php if (isset($score[0])): ?>
            <td><?= $score[0] ?></td>
        <?php endif; ?>
    </tr>
    <tr>
        <td>Twoes</td>
        <?php if (isset($score[1])): ?>
            <td><?= $score[1] ?></td>
        <?php endif; ?>
    </tr>
    <tr>
        <td>Threes</td>
        <?php if (isset($score[2])): ?>
            <td><?= $score[2] ?></td>
        <?php endif; ?>
    </tr>
    <tr>
        <td>Fours</td>
        <?php if (isset($score[3])): ?>
            <td><?= $score[3] ?></td>
        <?php endif; ?>
    </tr>
    <tr>
        <td>Fives</td>
        <?php if (isset($score[4])): ?>
            <td><?= $score[4] ?></td>
        <?php endif; ?>
    </tr>
    <tr>
        <td>Sixes</td>
        <?php if (isset($score[5])): ?>
            <td><?= $score[5] ?></td>
        <?php endif; ?>
    </tr>
</table>

<?php if (isset($gameover)) : ?>
    <p><?= $gameover ?></p>
<?php endif; ?>
