<?php

require "campos-naval.php";
require "valorcoluna-naval.php";

function inserirBarcos(&$campoPlayer,&$colun)
{
 for ($i=10; $i != 0; $i--) { 
    
    $linha = readline("Insira a letra da linha do barco n° $i:");
    $colun = readline("Insira o numero da coluna do barco n° $i:");

    $colunis = substituirLetras($colun);

    if($campoPlayer[$linha][$colunis] = "V"){
        echo "Posição ja ocupada!";
    }
    else {

   $campoPlayer[$linha][$colunis] = "V";

   exibeCampo($campoPlayer);
    }
 }
   
// foreach($campoPlayer as $linha){
//         foreach($linha as $item){
//             echo "$item\t";
//         }
//         echo "\n";
//     }
//  }
}
$campoPlayer = campoPlayer();
inserirBarcos($campoPlayer,$colun);
// exibeCampo($campoPlayer);
?>