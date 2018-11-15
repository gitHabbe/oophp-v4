<?php

if (!$content) {
    return;
}
?>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Title</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>path</th>
        <th>slug</th>
    </tr>
<?php $id = -1; foreach ($content as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
    </tr>
<?php endforeach; ?>
</table>
