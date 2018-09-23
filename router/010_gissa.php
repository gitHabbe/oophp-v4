<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Showing GET version of guessing game.
 */
$app->router->get("gissa/get", function () use ($app) {

    $res = null;
    $number = $_GET["number"] ?? -1;
    $tries  = $_GET["tries"] ?? 6;
    $guess  = $_GET["guess"] ?? null;

    // $game = new \Hab\Guess\Guess(intval($number), intval($tries), intval($tries));
    $game = new \Hab\Guess\Guess(intval($number), intval($tries));

    if (isset($_GET["takeGuess"])) {
        $res = $game->makeGuess(intval($guess));
    }
    
    if (isset($_GET["reset"])) {
        $game->random();
    }

    $data = [
        "title" => "Gissa [GET]",
        "game" => $game,
        "number" => $number,
        "guess" => $guess,
        "res" => $res,
    ];

    $app->view->add("anax/v2/guess/get", $data);

    return $app->page->render($data);
});

/**
 * Showing POST version of guessing game.
 */
$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {

    $res = null;
    $number = $_POST["number"] ?? -1;
    $tries  = $_POST["tries"] ?? 6;
    $guess  = $_POST["guess"] ?? null;

    // $game = new \Hab\Guess\Guess(intval($number), intval($tries), intval($tries));
    $game = new \Hab\Guess\Guess(intval($number), intval($tries));

    if (isset($_POST["takeGuess"])) {
        $res = $game->makeGuess(intval($guess));
    }
    
    if (isset($_POST["reset"])) {
        $game->random();
    }

    $data = [
        "title" => "Gissa [POST]",
        "game" => $game,
        "number" => $number,
        "guess" => $guess,
        "res" => $res,
    ];

    $app->view->add("anax/v2/guess/post", $data);

    return $app->page->render($data);
});

/**
 * Showing SESSION version of guessing game.
 */
$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {
    // echo session_name() . "<br>";
    $number = $_SESSION["number"] ?? -1;
    $tries  = $_SESSION["tries"] ?? 6;
    $guess  = $_POST["guess"] ?? null;

    // $game = new \Hab\Guess\Guess(intval($number), intval($tries), intval($tries));
    $game = new \Hab\Guess\Guess(intval($number), intval($tries));
    
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
    
    $res = null;

    // print_r($app->session);
    
    if (isset($_POST["takeGuess"])) {
        $guess = $_POST["guess"];
        $res = $game->makeGuess(intval($guess));
        $_SESSION["tries"] = $game->tries();
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
        $tries = 6;
        // $game = new \Hab\Guess\Guess(intval($number), intval($tries), intval($tries));
        $game = new \Hab\Guess\Guess(intval($number), intval($tries));
        $_SESSION["tries"] = 6;
        // echo "session destroyed";
    }

    $data = [
        "title" => "Gissa [SESSION]",
        "class" => "guessGame",
        "game" => $game,
        "number" => $number,
        "guess" => $guess,
        "res" => $res,
    ];

    $app->view->add("anax/v2/guess/session", $data);
    return $app->page->render($data);
});
