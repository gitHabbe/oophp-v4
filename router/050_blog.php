<?php

$app->router->any(["GET", "POST"], "blog/all", function () use ($app) {
    $data = [];
    $data["title"] = "Blog title";
    $params = [];
    $app->db->connect();
    $sql = "SELECT * FROM content;";
    $app->page->add("anax/v2/blog/navbar");

    $route = $app->request->getGet("route", "");
    switch ($route) {
        case "admin":
            $res = $app->db->executeFetchAll($sql);
            $data["movies"] = $res;
            $app->page->add("anax/v2/blog/admin-list", $data);
            $sql = "select id from content where id = 9999;";
            break;
        case "add":
            $app->page->add("anax/v2/blog/create-new");
            if ($app->request->getPost("contentTitle")) {
                $title = $app->request->getPost("contentTitle");
                array_push($params, $title);
                $sql = "INSERT INTO content (title) VALUES (?);";
                $res = $app->db->executeFetchAll($sql, $params);
                $id = $app->db->lastInsertId();
                $sql = "SELECT * FROM content;";
                $params = [];
                $app->response->redirect("blog/all?route=add-big&id=$id");
            }
            break;
        case "add-big":
            $id = $app->request->getGet("id");
            array_push($params, $id);
            $sql = "SELECT * FROM content WHERE id = ?;";
            $res = $app->db->executeFetchAll($sql, $params);
            $data["id"] = $res[0]->id;
            $data["title"] = $res[0]->title;
            $app->page->add("anax/v2/blog/create-new-big", $data);
            $test = $app->request->getPost("doSave");
            if ($app->request->getPost("doSave")) {
                $params = [];
                $contentTitle = $app->request->getPost("contentTitle", "");
                $contentPath = $app->request->getPost("contentPath", null);
                $contentSlug = $app->request->getPost("contentSlug", null);
                $contentData = $app->request->getPost("contentData", "");
                $contentType = $app->request->getPost("contentType", "");
                $contentFilter = $app->request->getPost("contentFilter", "");
                $contentPublish = $app->request->getPost("contentPublish", "");
                if (!$contentSlug) {
                    $contentSlug = slugify($contentTitle);
                }
                $sql = "SELECT * FROM content WHERE slug = ?;";
                $params = ($contentSlug == null) ? [$contentSlug] : [null];
                $res = $app->db->executeFetchAll($sql, $params);
                echo '<pre>' , var_dump($res) , '</pre>';
                if ($res && $res[0]->slug != null) {
                    $data["slug"] = $res[0]->slug;
                    $app->response->redirect("blog/all?route=error&msg=slug");
                    break;
                }
                $sql = "SELECT * FROM content WHERE path = ?;";
                $params = [$contentPath];
                $res = $app->db->executeFetchAll($sql, $params);
                if ($res && $res[0]->path != null) {
                    $data["path"] = $res[0]->path;
                    $app->response->redirect("blog/all?route=error&msg=path");
                    break;
                }
                echo '<pre>' , var_dump($res) , '</pre>';
                $params = [];
                array_push($params, $contentTitle, $contentPath, $contentSlug,
                    $contentData, $contentType, $contentFilter, $contentPublish, $id);
                $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
                $res = $app->db->executeFetchAll($sql, $params);
            }
            if ($app->request->getPost("doDelete")) {
                $app->response->redirect("blog/all?route=delete&id=$id");
            }
            break;
        case "delete":
            $id = $app->request->getGet("id");
            array_push($params, $id);
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $app->db->execute($sql, $params);
            break;

        case "error":
            $app->page->add("anax/v2/blog/error", $data);
            $sql = "select id from content where id = 9999;";
            $params = [];         
            break;
        default:
            // echo "default";
            break;
    }

    if ($params) {
        $res = $app->db->executeFetchAll($sql, $params);
    } else {
        $res = $app->db->executeFetchAll($sql);
    }
    $data["content"] = $res;
    $app->view->add("anax/v2/blog/list-all", $data);
    return $app->page->render($data);
});

$app->router->get("blog/post/{slug}", function ($slug) use ($app) {
    $textFilter = new \Hab\TextFilter2\TextFilter2();
    // echo '<pre>' , var_dump($textFilter) , '</pre>';
    $app->db->connect();
    if ($slug) {
        // echo "slug provided: " . $slug;
        $params = ["post", $slug];
        $sql = <<<EOD
SELECT
    *
FROM content
WHERE 
    type = ?
    AND slug = ?
;
EOD;
    } else {
        $params = ["post"];
        $sql = "SELECT * FROM content WHERE type = ?";
    }
    $res = $app->db->executeFetch($sql, $params);
    $data["title"] = $res->title;

    $filter = (strlen($res->filter) > 0) ? explode(",", $res->filter) : "";
    // echo '<pre>' , var_dump($filter) , '</pre>';
    // echo '<pre>' , var_dump($res) , '</pre>';
    $data["post"] = $res;
    $data["data"] = $textFilter->parse($res->data, $filter);
    $app->view->add("anax/v2/blog/post", $data);
    return $app->page->render($data);
});

$app->router->get("blog/page/{path}", function ($path) use ($app) {
    $textFilter = new \Hab\TextFilter2\TextFilter2();
    $app->db->connect();
    if ($path) {
        // echo "slug provided: " . $slug;
        $params = ["page", $path];
        $sql = <<<EOD
SELECT
    *
FROM content
WHERE 
    type = ?
    AND path = ?
;
EOD;
    } else {
        $params = ["page"];
        $sql = "SELECT * FROM content WHERE type = ?";
    }
    $res = $app->db->executeFetch($sql, $params);
    $filter = (strlen($res->filter) > 0) ? explode(",", $res->filter) : "";
    // $filter = [];
    echo '<pre>' , var_dump($filter) , '</pre>';
    $data["data"] = $textFilter->parse($res->data, $filter);

    $data["title"] = $res->title;
    $app->view->add("anax/v2/blog/page", $data);
    return $app->page->render($data);
});
