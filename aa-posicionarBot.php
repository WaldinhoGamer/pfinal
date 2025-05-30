<?php


require_once "aa-matrizbase.php"; 

function posicaoBot($campoBotEntrada)
{
    $campoBot = $campoBotEntrada; 
    $pecasColocadas = 0;
    $maxTentativasGeral = 1000;
    $tentativasAtuais = 0;

    while ($pecasColocadas < 10 && $tentativasAtuais < $maxTentativasGeral) {
        $tentativasAtuais++;

       
        $linha = random_int(1, 10);
        $coluna = random_int(1, 10);

        // Validação para não sobrepor barcos
        
        if ($campoBot[$linha][$coluna] === "~") {
            $campoBot[$linha][$coluna] = "V"; 
            $pecasColocadas++;               
        }
      
    }

    if ($pecasColocadas < 10) {
        
        echo "Aviso: Apenas $pecasColocadas de 10 peças foram colocadas após $maxTentativasGeral tentativas.\n";
    }

   
    return $campoBot;
}