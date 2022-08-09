
<?php
require 'lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css?r=<?= rand(1,100) ?>">
    <title>game tic-tac-toe</title>
</head>
<body>
<div class="game-container">

    <form action="index.php" class="game" method="POST">
<?php if(checkWinner()): ?>
    <h2 class = "winner"><?= checkWinner() ?></h2>
<?php endif; ?>
        <?php gamePlay(); ?>
        <input type='submit' class='reset' name='reset' value='شروع دوباره'>
    </form>
</div>
</body>
</html>