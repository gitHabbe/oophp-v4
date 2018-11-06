<?php

$app->router->get("movie/movies", function () use ($app) {
    $data = [];
    $searchParams = [];
    $route = $app->request->getGet("route", "");
    echo '<pre>' , var_dump($route) , '</pre>';
    
    $app->db->connect();
    switch ($route) {
        case "":
        case "index":
            $data["title"] = "Movie database | oophp";
            $sql = "SELECT * FROM movie;";
            break;
        case "get-title":
            $app->page->add("anax/v2/movie/movie-search", $data);
            $data["search-title"] = "Search movie database | oophp";
            $sql = "SELECT * FROM movie;";
            break;
        case "search-title":
            array_push($searchParams, $app->request->getGet("movie-name", ""));
            $data["search-title"] = "Search movie database | oophp";
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            break;
        case "get-year":
            $app->page->add("anax/v2/movie/movie-search-year");
            $data["search-title"] = "Search movie database | oophp";
            $sql = "SELECT * FROM movie;";
            break;
        case "search-year":
            $year1 = $app->request->getGet("year1", "");
            $year2 = $app->request->getGet("year2", "");
            array_push($searchParams, $year1, $year2);
            if ($year1 && $year2) {
                $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            } elseif ($year1) {
                $sql = "SELECT * FROM movie WHERE year >= ?;";
            } elseif ($year2) {
                $sql = "SELECT * FROM movie WHERE year <= ?;";
            }
            break;

        default:
            $data["title"] = "Default movie database | oophp";
            $sql = "SELECT * FROM movie;";
            break;
    }
    if ($searchParams) {
        $res = $app->db->executeFetchAll($sql, $searchParams);
    } else {
        $res = $app->db->executeFetchAll($sql);
    }
    $data["movies"] = $res;
    $app->view->add("anax/v2/movie/movie", $data);
        
        
    return $app->page->render($data);
});

$app->router->get("movie/search-movies", function () use ($app) {
    $data["title"] = "Search movie database | oophp";
    $app->view->add("anax/v2/movie/movie-search", $data);
        
    return $app->page->render($data);
});
