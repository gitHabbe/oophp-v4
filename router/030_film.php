<?php

$app->router->get("movies", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $data["movies"] = $res;

    // $app->page->add("movie/movie", [
    //     "res" => $res,
    // ]);

    // return $app->page->render([
    //     "title" => $title,
    // ]);
    $app->view->add("anax/v2/movie/movie", $data);
    return $app->page->render($data);
});