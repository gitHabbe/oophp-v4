<?php

// namespace Hab;

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

$title = "(GET) Guess number";

$number = $_GET["number"] ?? -1;
$tries  = $_GET["tries"] ?? 6;
$guess  = $_GET["guess"] ?? null;

// echo "tries is: ";
// print_r($tries);
// echo "number is: ";
// print_r($number);
// echo "guess is: ";
// var_dump($guess);

// $game = new Guess(intval($number), intval($tries), intval($tries));
$game = new Guess(intval($number), intval($tries));

$res = null;
if (isset($_GET["takeGuess"])) {
    $res = $game->makeGuess(intval($guess));
}

if (isset($_GET["reset"])) {
    $game->random();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GET guess</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>

    <h2>Make a guess!</h2>
    <h4>Between 1 - 100</h4>
    <h5>You have <?= $game->tries() ?> tries left.</h5>
    <a href="?reset">Reset game</a>
    <br />
    <form action="index_get.php" method="get">
        <input type="hidden" name="number" value="<?= $game->number() ?>">
        <input type="hidden" name="tries" value="<?= $game->tries() ?>">
        <?php if ($number != $guess) : ?>
            <input type="text" name="guess" id="guess">
            <button name="takeGuess" type="submit">Make guess</button>
            <button name="cheat" type="submit">Cheat</button>
        <?php endif; ?>
    </form>
    
    <?php if (isset($res)) : ?>
        <p>Your guess was <?= $res ?></p>
    <?php endif; ?>

    <?php if (isset($_GET["cheat"])) : ?>
        <p>Number is: <?= $game->number() ?></p>
    <?php endif; ?>
</body>
</html>
