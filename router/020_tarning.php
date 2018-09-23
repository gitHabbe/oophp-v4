<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Setup game using GET route.
 */
$app->router->get("tarning/setup", function () use ($app) {
    
    $data = [
        "title" => "Tärningsspel 100 setup"
    ];
    
    $app->view->add("anax/v2/dice/diceSetup", $data);
    
    return $app->page->render($data);
});

/**
 * Start game using POST route.
 */
$app->router->post("tarning/start", function () use ($app) {
    $app->session->delete("DiceGame");
    $app->session->destroy();
    // $playerCount    = 3;
    // $diceCount      = 3;
    $playerCount    = $_POST["playerCount"];
    $diceCount      = $_POST["diceCount"];
    $game = $app->session->get("DiceGame");
    if (!$game) {
        $game = new \Hab\Dice\DiceGame(intval($playerCount), intval($diceCount));
        $game->init();
        // $game = new \Hab\Dice\DiceGame();
        // echo '$game' . ': ';
        // var_dump($game);
        $app->session->set("DiceGame", $game);
    }

    $data = [
        "title" => "playing",
        "game" => $game
    ];

    $app->view->add("anax/v2/dice/diceStart", $data);
    
    return $app->page->render($data);
});

$app->router->post("tarning/round", function () use ($app) {
    $game = $app->session->get("DiceGame");
    echo "<pre>" , var_dump($game) , "</pre>";
    var_dump($game->players());
    $data = [
        "title" => "processing",
        "game" => $game
    ];

    $app->response->redirect("tarning/game");
});
