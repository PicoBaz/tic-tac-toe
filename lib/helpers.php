<?php

session_start();
if(! isset($_SESSION['stop']))
{
    gameStart();
}
checkWinner();
resetGame();

function gameStart()
{

    $_SESSION['game'] = 
    [
                    1=> null,
                    2=> null,
                    3=> null,
                    4=> null,
                    5=> null,
                    6=> null,
                    7=> null,
                    8=> null,
                    9=> null
          
    ];
    $_SESSION['start'] = 'X';
    $_SESSION['stop'] = 'stop';
    
}

function gamePlay()
{
    foreach ($_SESSION['game'] as $cell => $val)
    {
        if($val == null)
        {
            $where = '';
            $class = '';
        }
        else
        {
            $where = 'disabled';
            if($val == 'X')
            {
                $class = 'X-player';
            }
            else
            {
                $class = 'O-player';
            }
        }
        $createCell = 
        "
        <input type='submit' class='cell $class' name='cell$cell' value='$val' $where>
        ";
        echo $createCell;
    }

}

function resetGame()
{
    if (isset($_POST['reset']) or $_SESSION['reset'])
    {
        gameStart();
        unset($winner);
    }
    else
    {
        return false;
    }
}

foreach ($_SESSION['game'] as $cell => $val)
{
    if(isset($_POST['cell' . $cell]))
    {
        
        $_SESSION['game'][$cell] = $_SESSION['start'];
        if ($_SESSION['start'] == 'X')
        {
            $_SESSION['start'] = 'O';
        }
        else
        {
            $_SESSION['start'] = 'X';
        }
    }
}
function checkWinner()
{
    $game = $_SESSION['game'];
    $winner = false;
    $_SESSION['reset'] = false;
    if
    (
        ($game['1'] && $game['1'] == $game['2'] && $game['2'] == $game['3']) or
        ($game['4'] && $game['4'] == $game['5'] && $game['5'] == $game['6']) or
        ($game['7'] && $game['7'] == $game['8'] && $game['8'] == $game['9']) or

        ($game['1'] && $game['1'] == $game['4'] && $game['4'] == $game['7']) or
        ($game['2'] && $game['2'] == $game['5'] && $game['5'] == $game['8']) or
        ($game['3'] && $game['3'] == $game['6'] && $game['6'] == $game['9']) or

        ($game['1'] && $game['1'] == $game['5'] && $game['5'] == $game['9']) or
        ($game['3'] && $game['3'] == $game['5'] && $game['5'] == $game['7'])
    )
    {
           
        if ($_SESSION['start'] == 'X')
        {
            $winner = 'O برنده شد';
            $_SESSION['reset'] = true;
        }
        else
        {
            $winner = 'X برنده شد';
            $_SESSION['reset'] = true;
        }

        return $winner;
    }
    else
    {
        if (!in_array(null,$game))
        {
            $winner = 'مساوی';
            $_SESSION['reset'] = true;
            return $winner;
        }
    }
}


