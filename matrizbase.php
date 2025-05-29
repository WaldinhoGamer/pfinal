<?php

// Vai ser a base de jogadas do player //////
function exibeCampo($campo)
{
    echo "\n";
    echo "Este é seu campo atual!\n";
    foreach($campo as $linha){
        foreach($linha as $elemento){
            echo "$elemento ";
        }
        echo "\n";
        
    }
}
function campoPlayer()
{
    //// PREENCHE COM . AS FILEIRAS
    $campoPlayer = array_fill(0, 11, array_fill(0, 11, "~"));
    ///

    
    $campoPlayer[0][0]=null;
    
    $campoPlayer[1][0] = "A";
    $campoPlayer[2][0] = "B";
    $campoPlayer[3][0] = "C";
    $campoPlayer[4][0] = "D";
    $campoPlayer[5][0] = "E";
    $campoPlayer[6][0] = "F";
    $campoPlayer[7][0] = "G";
    $campoPlayer[8][0] = "H";
    $campoPlayer[9][0] = "I";
    $campoPlayer[10][0] = "J";

    $campoPlayer[0][1] = 1;
    $campoPlayer[0][2] = 2;
    $campoPlayer[0][3] = 3;
    $campoPlayer[0][4] = 4;
    $campoPlayer[0][5] = 5;
    $campoPlayer[0][6] = 6;
    $campoPlayer[0][7] = 7;
    $campoPlayer[0][8] = 8;
    $campoPlayer[0][9] = 9;
    $campoPlayer[0][10] = 10;
    return $campoPlayer;
}

/// Base de jogadas do bot ////

function campoBot()
{
     //// PREENCHE COM . AS FILEIRAS
     $campoPlayer = array_fill(0, 11, array_fill(0, 11, "~"));
     ///
     
    $campoBot[0][0]=null;
    
    $campoBot[1][0] = "A";
    $campoBot[2][0] = "B";
    $campoBot[3][0] = "C";
    $campoBot[4][0] = "D";
    $campoBot[5][0] = "E";
    $campoBot[6][0] = "F";
    $campoBot[7][0] = "G";
    $campoBot[8][0] = "H";
    $campoBot[9][0] = "I";
    $campoBot[10][0] = "J";

    $campoBot[0][1] = 1;
    $campoBot[0][2] = 2;
    $campoBot[0][3] = 3;
    $campoBot[0][4] = 4;
    $campoBot[0][5] = 5;
    $campoBot[0][6] = 6;
    $campoBot[0][7] = 7;
    $campoBot[0][8] = 8;
    $campoBot[0][9] = 9;
    $campoBot[0][10] = 10;

    return $campoBot;
}

?>
