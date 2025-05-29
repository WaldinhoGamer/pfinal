<?php

require "separaC.php";
require "matrizbase.php";
require "letraPraNum.php";

function pedirPosicoes($campoPlayer)
{
   

    for($numPosicoes = 1;$numPosicoes <=10;$numPosicoes++){

        $posicao = readline("Digite onde deseja posicionar seu ". $numPosicoes. "º barco -- :");


        /// Validação
        if (empty($posicao) || strlen($posicao) < 2) {
            echo "Entrada inválida. Tente novamente.\n";
            $numPosicoes--; 
            continue;
            }


        /// SEPARAR letra de numero

        $letra = transferLetra($posicao);
        $numStr = transferNum($posicao);

    

       // VALIDAÇÃO MAIS ROBUSTA (depois de separar)
       if (empty($letra) || !ctype_alpha($letra) || strlen($letra) !== 1) { // Garante uma única letra
        echo "Letra da posição inválida. Tente novamente (ex: A1).\n";
        $numPosicoes--; 
        continue;
    }
    if (empty($numStr) || !ctype_digit($numStr)) { // Garante que são apenas dígitos
        echo "Número da posição inválido. Tente novamente (ex: A1).\n";
        $numPosicoes--; 
        continue;
    }

    $letraNum = substituirLetras($letra); // Converte 'A' para 1, 'B' para 2, etc.
    $num = (int)$numStr;                  // Converte "1" para 1

    // VALIDAÇÃO DOS LIMITES DO TABULEIRO
    // $letraNum deve estar entre 1 (A) e 10 (J)
    // $num deve estar entre 1 e 10
    if ($letraNum < 1 || $letraNum > 10 || $num < 1 || $num > 10) {
        echo "Posição fora do tabuleiro (A-J, 1-10). Tente novamente.\n";
        $numPosicoes--;
        continue;
    }

    // Validação para não sobrepor barcos
    if ($campoPlayer[$letraNum][$num] === "🛥️ ") {
        echo "Já existe um barco nesta posição. Tente novamente.\n";
        $numPosicoes--;
        continue;
    }


        $campoPlayer[$letraNum][$num] = "🛥️ ";

        exibeCampo($campoPlayer);
    }

    return $campoPlayer;
}

$campoPlayer = campoPlayer();

exibeCampo($campoPlayer);
echo "\n";
echo "Esse é seu campo! Insira dentro dele seus barcos respeitando o formato das posições, sendo letra e numero( EXEMPLO: A4 ). \n";
$campoPlayer = pedirPosicoes($campoPlayer);
exibeCampo($campoPlayer);
    