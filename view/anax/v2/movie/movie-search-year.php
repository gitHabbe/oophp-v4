<br>
<form method="get">
    <input type="hidden" name="route" value="search-year">
    <label>Year: 
    <input type="number" name="year1" value="<?= $year1 ?: 1900 ?>" min="1900" max="2100"/>
    - 
    <input type="number" name="year2" value="<?= $year2  ?: 2100 ?>" min="1900" max="2100"/>
    </label>
    <button type="submit">Search</button>
</form>
