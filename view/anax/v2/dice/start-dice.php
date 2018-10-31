<?php
echo "Histogram<br>";
echo $game->getHistogram() . "<br>";
// $test = $game->showTest();
// echo "<pre>";
// var_dump($test);
// echo "</pre>";
echo "<br>ComputerCurrent: ";
echo $game->computerCurrent();
echo "<br>";
echo "ComputerTotal: ";
echo $game->computerTotal();
echo "<br>";
echo "PlayerCurrent: ";
echo $game->playerCurrent();
echo "<br>";
echo "PlayerTotal: ";
echo $game->playerTotal();
echo "<br>";
echo "=============<br>";
?>
<br>
<a href="roll">Roll</a>
----
<a href="stay">Stay</a>
<br>
<?php
// echo "<pre>";
// var_dump($game->rounds()[count($game->rounds()) - 1]->playerHands());
// echo "</pre>";
echo $game->gameInfo();

?>

<!-- <form action="roll" method="post">
    <button type="submit">Roll</button>
</form>
<br>
<form action="stay" method="post">
    <button type="submit">Stay</button>
</form> -->

<?php

// echo "<pre>";
// var_dump($game->rounds());
// echo "</pre>";