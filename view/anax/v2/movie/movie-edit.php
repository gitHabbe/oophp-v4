<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="movieId" value="<?= $movieId ?>"/>
        <label>Title:
            <input type="text" name="movieTitle" value="<?= $movieTitle ?>"/>
        </label><br>
        <label>Year: 
            <input type="number" name="movieYear" value="<?= $movieYear ?>"/>
        <label><br>
            Image: 
            <input type="text" name="movieImage" value="<?= $movieImage ?>"/>
        </label><br>
        <input type="submit" name="doSave" value="Save">
        <input type="reset" value="Reset">
        <a href="?route=movie-select">Select movie</a> |
        <a href="?">Show all</a>
    </fieldset>
</form>
