<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="movieId" value="<?= $movieId ?>"/>
        <label>Title:
            <input type="text" name="movieTitle" value=""/>
        </label><br>
        <label>Year: 
            <input type="number" name="movieYear" value=""/>
        <label><br>
            Image: 
            <input type="text" name="movieImage" value="img/noimg.png"/>
        </label><br>
        <input type="submit" name="doAdd" value="Add">
        <a href="?route=movie-select">Select movie</a> |
        <a href="?">Show all</a>
    </fieldset>
</form>
