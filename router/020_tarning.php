<?php

$app->router->get("tarning/setup", function () use ($app) {
    $app->session->delete("DiceGame");
    $app->session->destroy();
    
    $data = [
        "title" => "Tärningsspel 100 setup"
    ];
    
    $app->view->add("anax/v2/dice/setup-dice", $data);
    
    return $app->page->render($data);
});

$app->router->get("tarning/start", function () use ($app) {
    $game = $app->session->get("DiceGame");
    if (!$game) {
        $game = new \Hab\Dice\DiceGame();
        $app->session->set("DiceGame", $game);
    }

    $data = [
        "title" => "playing",
        "game" => $game
    ];

    $app->view->add("anax/v2/dice/start-dice", $data);
    
    return $app->page->render($data);
});

$app->router->get("tarning/roll", function () use ($app) {
    $game = $app->session->get("DiceGame");
    $game->playPlayer();

    $app->response->redirect("tarning/start");
});

// $app->router->get("tarning/computer-roll", function () use ($app) {
//     $game = $app->session->get("DiceGame");
//     $game->play();

//     $app->response->redirect("tarning/start");
// });

$app->router->get("tarning/stay", function () use ($app) {
    $game = $app->session->get("DiceGame");
    $game->stay();

    $app->response->redirect("tarning/start");
});
