<?php

// namespace Hab;

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

$title = "(POST) Guess number";

$number = $_POST["number"] ?? -1;
$tries  = $_POST["tries"] ?? 6;
$guess  = $_POST["guess"] ?? null;

// echo "tries is: ";
// print_r($tries);
// echo "number is: ";
// print_r($number);
// echo "guess is: ";
// var_dump($guess);

$game = new Guess(intval($number), intval($tries));

$res = null;
if (isset($_POST["takeGuess"])) {
    $res = $game->makeGuess(intval($guess));
}

if (isset($_POST["reset"])) {
    $game->random();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>POST guess</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>

    <h2>Make a guess!</h2>
    <h4>Between 1 - 100</h4>
    <h5>You have <?= $game->tries() ?> tries left.</h5>
    <form action="index_post.php" method="post">
    <input type="hidden" name="reset">
        <button type="submit">Reset</button>
    </form>
    <!-- <a href="?reset">Reset game</a> -->
    <br />
    <form action="index_post.php" method="post">
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

    <?php if (isset($_POST["cheat"])) : ?>
        <p>Number is: <?= $game->number() ?></p>
    <?php endif; ?>
</body>
</html>
