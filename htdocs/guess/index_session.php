<?php

// namespace Hab;

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

$title = "(SESSION) Guess number";

$number = $_POST["number"] ?? -1;
$tries  = $_POST["tries"] ?? 6;
$guess  = $_POST["guess"] ?? null;

session_name("hab");
echo session_name();
session_start();

if (!isset($_SESSION["number"])) {
    $_SESSION["number"] = $number;
}

if (!isset($_SESSION["tries"])) {
    $_SESSION["tries"] = $tries;
}

if (!isset($_SESSION["guess"])) {
    $_SESSION["guess"] = $guess;
}

$game = new Guess(intval($number), intval($tries));

$res = null;

if (isset($_POST["takeGuess"])) {
    $res = $game->makeGuess(intval($guess));
}

if (isset($_POST["reset"])) {
    $_SESSION = [];
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
    $game->random();
    $_SESSION["number"] = $game->number();
    echo "session destroyed";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SESSION guess</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>

    <h2>Make a guess!</h2>
    <h4>Between 1 - 100</h4>
    <h5>You have <?= $game->tries() ?> tries left.</h5>
    <form action="index_session.php" method="post">
    <input type="hidden" name="reset">
        <button type="submit">Reset</button>
    </form>
    <!-- <a href="?reset">Reset game</a> -->
    <br />
    <form action="index_session.php" method="post">
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
