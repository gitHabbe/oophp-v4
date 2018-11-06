<navbar class="navbar">
    <a href="?route=select">SELECT *</a> |
    <a href="?route=get-title">Search title</a> |
    <a href="?route=get-year">Search year</a> |
    <a href="?route=movie-edit">Edit</a> |
    <!-- <a href="?">Show all movies</a> | -->
    <!-- <a href="?route=reset">Reset database</a> | -->
    <!-- <a href="?route=movie-select">Select</a> | -->
    <!-- <a href="?route=show-all-sort">Show all sortable</a> | -->
    <!-- <a href="?route=show-all-paginate">Show all paginate</a> | -->
</navbar> 
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
    <?php $id = -1; foreach ($movies as $row) : $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
    <?php endforeach; ?>
</table>
