<?php

$app->router->any(["GET", "POST"], "movie/movies", function () use ($app) {
    $data = [];
    $searchParams = [];
    $app->db->connect();

    $route = $app->request->getGet("route", "");
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
            $data["title"] = "Search movie database | oophp";
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            break;
        case "get-year":
            $app->page->add("anax/v2/movie/movie-search-year");
            $data["title"] = "Search movie database | oophp";
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
        case "select-movie":
            $sql = "SELECT id, title FROM movie;";
            $res = $app->db->executeFetchAll($sql, $searchParams);
            $data["movies"] = $res;
            $app->page->add("anax/v2/movie/movie-select", $data);
            $data["title"] = "Select movie database | oophp";
            $movieId = $app->request->getPost("movieId");
            if ($app->request->getPost("doDelete")) {
                $sql = "DELETE FROM movie WHERE id = ?;";
                $app->db->execute($sql, [$movieId]);
            } elseif ($app->request->getPost("doAdd")) {
                $app->response->redirect("movie/movies?route=add-movie");
                $movieId = $app->db->lastInsertId();
            } elseif ($app->request->getPost("doEdit") && is_numeric($movieId)) {
                $app->response->redirect("movie/movies?route=edit-movie&movieId=$movieId");
            }
            $sql = "SELECT * FROM movie;";
            break;
        case "edit-movie":
            $data["title"]      = "Edit movie | oophp";
            $sql = "SELECT * FROM movie WHERE id = ?;";
            $movieId = $app->request->getGet("movieId");
            array_push($searchParams, $movieId);
            $res = $app->db->executeFetchAll($sql, $searchParams);
            $searchParams = [];
            $data["movieId"] = $res[0]->id;
            $data["movieTitle"] = $res[0]->title;
            $data["movieYear"]  = $res[0]->year;
            $data["movieImage"] = $res[0]->image;
            $app->page->add("anax/v2/movie/movie-edit", $data);
            if ($app->request->getPost("doSave")) {
                $newMovieTitle  = $app->request->getPost("movieTitle");
                $newMovieYear   = $app->request->getPost("movieYear");
                $newMovieImage  = $app->request->getPost("movieImage");
                $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
                $res = $app->db->execute($sql, [
                    $newMovieTitle, $newMovieYear, $newMovieImage, $data["movieId"]
                ]);
                $sql = "SELECT * FROM movie;";
            } else {
                $sql = "SELECT * FROM movie;";
            }
            break;
        case "add-movie":
            $data["title"] = "Add movie | oophp";
            $app->page->add("anax/v2/movie/movie-add", $data);
            if ($app->request->getPost("doAdd")) {
                $newMovieTitle  = $app->request->getPost("movieTitle");
                $newMovieYear   = $app->request->getPost("movieYear");
                $newMovieImage  = $app->request->getPost("movieImage"); 
                $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
                $app->db->execute($sql, [$newMovieTitle, $newMovieYear, $newMovieImage]);
            }
            $sql = "SELECT * FROM movie;";

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
