<?php

if (!$post) {
    echo "<p>No blog post with that slug</p>";
    return;
}

?>

<h4><?= $post->title ?></h4>
<p><?= $data ?></p>
