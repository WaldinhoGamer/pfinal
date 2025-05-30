<?php

require_once "posicionar.php"; // MUDANÇA
require_once "posicionarBot.php"; // MUDANÇA
require_once "matrizbase.php"; // MUDANÇA
require_once "separaC.php"; // MUDANÇA
require_once "letraPraNum.php"; //


echo "=== Simbolos de Tabuleiro ===\n";
echo "X - Localização  atirada sem barco.\n";
echo "O - Localização atirada com barco.\n";
echo "V - Seu barco.\n";
echo "Lembre de respeitar a formatação de posições (ex: a4)\n";
echo "=========================\n";
    

function jogarNaval()
{ 

   
    function vezPlayer($campoInimigo,$campoPlayer)
    {
        $campoplay = campoBot();
        

        do {
        
            exibirCampo($campoplay); /// Bota pra exibir um campo antes de jogo

            $artilharia = readline("Capitão, para onde devemos atirar nosso canhão? -- :");

            ///CONVERSÃO LETRA E NUMERO ///
            $letra = transferLetra($artilharia);
            $numStr = transferNum($artilharia);

            $letraNum = substituirLetras($letra); 
            $num = (int)$numStr; 
            ///////////////////////////////////

            if($campoInimigo[$letraNum][$num] === "V"){
                $campo[$letraNum][$num] = "O"; /// Return
                $campoInimigo[$letraNum][$num] = "O"; /// Return

            }
            else{
                exibeCampo($campoplay);
                echo "Errou o tiro, nada indentificado!\n";
                break;
            }

         } while($campoInimigo[$letraNum][$num] === "V");

         return $campoplay;
    }


    }







  

      

    