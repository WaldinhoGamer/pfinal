<?php

require_once "separaC.php";
require_once "posicionar.php";
require_once "matrizbase.php";
require_once "letraPraNum.php";
require_once "posicionarBot.php";


/////////////////////////////////////////

$campoBotVisivel = campoBot();
$campoBotOriginal = posicaoBot($campoVisivel);
$campoPlayer = campoPlayer();
$campoPlayerJogo = pedirPosicoes($campoPlayer);

$barcosPlayer = 10;
$barcosBot = 10;
$turnoPlayer = true;
/////////////////////////////////////



while ($turnoPlayer == true) {

    echo "/// CARREGAR OS CANHÕES /// \n";

    echo "Este é o campo inimigo \n";

    exibeCampo($campoVisivel);

    $posicao = readline("Insira a posição que deseja atacar --:\n");

    /// SEPARAR letra de numero

        $letra = transferLetra($posicao);
        $numStr = transferNum($posicao);

        $letraNum = substituirLetras($letra); // Converte 'A' para 1, 'B' para 2, etc.
    $num = (int)$numStr; 

    if($campoBotOriginal[$letraNum][$num] === "O"||"X"){
        echo "Esta posição ja foi acertada!\n";
        continue;
    }
    if ($campoBotOriginal[$letraNum][$num] === "V"){
        echo "Acertou um!\n";
        $campoBotOriginal[$letraNum][$num] = "O";
        $campoBotVisivel[$letraNum][$num] = "O";
        $barcosBot -=1;
    
    }
    elseif($campoBotOriginal[$letraNum][$num] === "~"){
        echo "não havia barcos na região\n";
        $turnoPlayer = false;
        break;
    }
}

