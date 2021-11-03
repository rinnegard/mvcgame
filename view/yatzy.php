<?php

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

 $_SESSION["yatzy"]->play();
 $die1 = $_SESSION["yatzy"]->show();
 $savedDie = $_SESSION["yatzy"]->showSaved();

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

<p><?= $savedDie ?></p>

<form  action="" method="post">
    <input type="submit" name="roll" value="Roll!">
</form>
