<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Showing GET version of guessing game.
 */
$app->router->get("tarning/game", function () use ($app) {

    // $game = new DiceGame();

    $data = [
        "title" => "Tärningsspel 100"
    ];

    $app->view->add("anax/v2/dice/dicegame", $data);

    return $app->page->render($data);
});
/**
 * Showing GET version of guessing game.
 */
$app->router->post("tarning/game", function () use ($app) {

    // $game = new DiceGame();

    $data = [
        "title" => "Tärningsspel 100 POST"
    ];

    $app->view->add("anax/v2/dice/dicegame", $data);

    return $app->page->render($data);
});