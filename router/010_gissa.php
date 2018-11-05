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
    $number = $app->request->getGet("number", -1);
    $tries  = $app->request->getGet("tries", 6);
    $guess  = $app->request->getGet("guess", null);

    $game = new \Hab\Guess\Guess(intval($number), intval($tries));

    // if ($app->request->getGet("takeGuess", null)) {
    if (isset($_GET["takeGuess"])) {
        $res = $game->makeGuess(intval($guess));
    }
    
    // if ($app->request->getGet("reset", null)) {
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
    $number = $app->request->getPost("number", -1);
    $tries  = $app->request->getPost("tries", 6);
    $guess  = $app->request->getPost("guess", null);

    $game = new \Hab\Guess\Guess(intval($number), intval($tries));

    // if ($app->request->getPost("takeGuess")) {
    if (isset($_POST["takeGuess"])) {
        $res = $game->makeGuess(intval($guess));
    }
    
    // if ($app->request->getPost("reset", null)) {
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
    
    $number = $app->session->get("number");
    $tries  = $app->session->get("tries");
    $guess  = $app->session->get("guess");

    $game = new \Hab\Guess\Guess(intval($number), intval($tries));
    // $app->session->set("DiceGame", $game);
    $app->session->set("number", $game->number());
    $app->session->set("tries", $game)->tries();
    
    $res = null;

    if ($app->request->getPost("takeGuess", null)) {
        // $guess = $_POST["guess"];
        $guess = $app->request->getPost("guess");
        $res = $game->makeGuess(intval($guess));
        // $_SESSION["tries"] = $game->tries();
        $app->session->set("tries", $game->tries());
    }
    
    if ($app->request->getPost("reset", null)) {
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
        $game = new \Hab\Guess\Guess(intval($number), intval($tries));
        $app->session->set("tries", 6);
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
