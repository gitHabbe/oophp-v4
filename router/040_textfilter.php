<?php


$app->router->get("filter/text", function () use ($app) {

    $data = [
        "title" => "Filter"
    ];

    $filter = new \Hab\TextFilter2\TextFilter2();
    $text = file_get_contents(__DIR__ . "/../htdocs/sample.md");
    $text = $filter->parse($text, ["bbcode", "markdown"]);
    $data["markdown"] = $text;

    $app->view->add("anax/v2/textfilter/textfilter", $data);
    
    return $app->page->render($data);
});
