
<div class="<?= $class ?>">
    <h2>Make a guess!</h2>
    <h4>Between 1 - 100</h4>
    <h5>You have <?= $game->tries() ?> tries left.</h5>
    <!-- <a href="?reset">Reset game</a> -->
    <form method="post">
    <input type="hidden" name="reset">
        <button type="submit">Reset</button>
    </form>
    <br>
    <form method="post">
        <input type="hidden" name="number" value="<?= $game->number() ?>">
        <input type="hidden" name="tries" value="<?= $game->tries() ?>">
        <?php if ($number != $guess) : ?>
            <input type="text" name="guess" id="guess">
            <button name="takeGuess" type="submit">Make guess</button>
            <button name="cheat" type="submit">Cheat</button>
        <?php endif; ?>
    </form>

    <?php if (isset($res)) : ?>
        <p>Your guess was <?= $res ?></p>
    <?php endif; ?>

    <?php if (isset($_POST["cheat"])) : ?>
        <p>Number is: <?= $game->number() ?></p>
    <?php endif; ?>

</div>