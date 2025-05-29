<?php

require "campos-naval.php";
require "valorcoluna-naval.php";
require "separaLetraNum.php";

function inserirBarcos(&$campoPlayer,&$colun,&$letra,&$numero)
{
 for ($i=10; $i != 0; $i--) { 
    
    $posicao = readline("Insira a posição do barco:");


   

    $colunis = substituirLetras($colun);

    
   $campoPlayer[$letra][$numero] = "V";

   exibeCampo($campoPlayer);
    
 }
   

}
$campoPlayer = campoPlayer();
inserirBarcos($campoPlayer,$colun);

?>