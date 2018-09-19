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
$app->router->post("tarning/game", function () use ($app) {


    $data = [
        "title" => "Tärningsspel 100",
        "playerCount" => $_POST["playerCount"],
        "diceCount" => $_POST["diceCount"]
    ];

    $app->view->add("anax/v2/dice/diceGame", $data);

    return $app->page->render($data);
});
