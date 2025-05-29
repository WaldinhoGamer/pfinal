<?php

require "separaC.php";
require "matrizbase.php";
require "letraPraNum.php";

function posicaoBot($campoBot)
{
   
    for($numPosicoes = 1;$numPosicoes <=10;$numPosicoes++){

        $linha = random_int(1,10);
        $coluna = random_int(1,10);


        // Validação para não sobrepor barcos
    if ($campoBot[$letraNum][$num] === "V") {
    
        $numPosicoes--;
        continue;
    }

     
    }
 
    



    


        $campoBot[$linha][$coluna] = "V";

        exibeCampo($campoBot);
    

    return $campoBot;
}

$campoBot = campoBot();

exibeCampo($campoBot);
$campoBot = posicaoBot($campoBot);
exibeCampo($campoBot);
    