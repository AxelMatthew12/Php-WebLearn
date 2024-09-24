<?php
//    Game kondisi ending

$bHasWinner = false;
$bIsTied = false;
$cWinner = '';
$casSquare = array('','','','','','','','','');

// new knowledge "_post" <<< learn that xelll >>>
if (isset($_POST["SubmitButton"])) {
    for($i = 0 ; $i < 9; ++$i){
        $caSquare[$i] = $_POST["Square".$i];
    }

    $iaaWins = array(
        array(0,1,2),
        array(3,4,5),
        array(6,7,8),
        array(0,3,6),
        array(1,4,7),
        array(2,5,8),
        array(0,4,8),
        array(2,4,6)
    );
    // cek status menang
    // tadi di perbaiki di penamaan $casSquare nya typo
    // perulangan masih murni tanpa gpt
    for($i = 0; $i < 4; $i++){
        $iDiff = $iaaWins[$i][0];
        $iLength = count($iaaWins[$i]);
        for($j = 1; $j < $iLength; $j++){
            $iStart = $iaaWins[$i][$j];
        if($casSquare[$iStart] !='') {
                if(($casSquare [$iStart] == $casSquare[$iStart + $iDiff]) &&
                ($casSquare[$iStart] == $casSquare[$iStart + 2*$iDiff])) {
                    $bHasWinner = true;
                    $cWinner = $casSquare[$iStart];
                }  

            }
        }
    }

    if  (!$bHasWinner) {
        $bTieCheck = true;
        for($i = 0; $i < 9; $i++){
            if($caSquare[$i] == '') {
                $bTieCheck = false;
            }
        }
        $bIsTied = $bTieCheck;
        if($bIsTied){
            printf('<div id="idMessage">%s</div>', "Tie game! ");
        }else {
            printf('<div id ="idMessage">%s</div>', "Tic Tac Toe");
        }
    }else {
        printf('<div id="idMessage">%s Wins!</div>',$cWinner);
    }
}else {
    printf('<div id ="idMessage">%s</div>', "Tic Tac Toe");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tic Tac Toe</title>
    <style type="text/css">
        #idMessage {
           color: aqua;
           background-color: #444444;
           width: 300px;
           font-size: 40px;
           font-family: arial;
           text-align: center;
        }

        #idSquare {
            background-color: #CCCCCC;
            border: 2px solid #444444;
            color: #000000;
            width: 100px;
            height: 100px;
            font-size: 66px;
            font-family: arial;
            text-align: center;
        }

        #idButton {
            background-color: #EEEEEE;
            border: 4px outset #CCCCCC;
            width: 300px;
            font-size: 40px;
            font-family: arial;
            text-align: center;
        }
    </style>
</head>
<body>
    <form name="TicTacToe" method="post"
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
    for ($i = 0; $i <= 8; $i++){
        $sSquare = '<input type="text" name="Square%s" value="%s" id="idSquare">';
        printf($sSquare, $i, $casSquare[$i]);

        if($i == 2 || $i == 5 || $i == 8){
            printf('<br />');
        }
    }
    if ($bHasWinner || $bIsTied) {
        $sThisFile = htmlspecialchars($_SERVER["PHP_SELF"]);
        printf('<input type="button" name="newgame" value="New Game"
        onclick="window.location.href=\''.$sThisFile.'\'" id="idButton">');
    } else {
        printf('<input type="submit" name="SubmitButton" value="Move" id="idButton">');
    }
    ?>
</form>
    
</body>
</html>
