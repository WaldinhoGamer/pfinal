<?php

require_once "separaPosicao.php";
require_once "posicionar.php"; 
require_once "matrizbase.php";
require_once "letraPraNum.php";
require_once "posicionarBot.php"; 

/////////////////////////////////////////


$campoBotVisivel = campoBot();


$campoBotOriginal = posicaoBot(campoBot()); 


$campoPlayer = campoPlayer();

$campoPlayerJogo = pedirPosicoes($campoPlayer); 

$barcosPlayer = 10; 
$barcosBot = 10;    
$turnoPlayer = true;
/////////////////////////////////////


while ($barcosPlayer > 0 && $barcosBot > 0) { 

    if ($turnoPlayer) {
        echo "Carregando jogo... aguarde \n";
        sleep(4);
        echo "/// SEU TURNO - CARREGAR OS CANHÕES /// \n";
        echo "Este é o campo inimigo :\n";
        echo exibeCampo($campoBotVisivel); 

        $posicao = readline("Insira a posição que deseja atacar (ex: A5) --:\n");
        $posicao = strtoupper(trim($posicao));

        // Validação básica do formato da entrada
        if (!preg_match('/^[A-J]([1-9]|10)$/', $posicao)) {
            echo "Entrada inválida. Use o formato LetraNumero (ex: A1, J10).\n";
            continue;
        }

        $letra = transferLetra($posicao);
        $numStr = transferNum($posicao);

        $letraNum = substituirLetras($letra); // Converte 'A' para 1, 'B' para 2, etc.
        $num = (int)$numStr;

        // Garante que os índices são válidos para o seu tabuleiro (supondo 1-10)
        if ($letraNum < 1 || $letraNum > 10 || $num < 1 || $num > 10) {
            echo "Posição fora do tabuleiro!\n";
            continue;
        }


        $alvo = $campoBotOriginal[$letraNum][$num];

        if ($alvo === "O" || $alvo === "X") {
            echo "Esta posição já foi atacada! Tente outra.\n";
            
            continue;
        } elseif ($alvo === "V") {
            sleep(2);
            echo "FOGO! Acertou um barco inimigo!\n";
            

            $campoBotOriginal[$letraNum][$num] = "O";  
            $campoBotVisivel[$letraNum][$num] = "O";   
            $barcosBot--;

            echo "Barcos inimigos restantes: $barcosBot\n";

            if ($barcosBot == 0) {
                echo exibeCampo($campoBotVisivel);
                echo "*********************************************\n";
                echo "PARABÉNS! Você afundou todos os barcos inimigos!\n";
                echo "*********************************************\n";
                break; // Termina o jogo
            }
           
        } elseif ($alvo === "~") { // É água
            echo "ÁGUA! Nenhum barco na região.\n";
            $campoBotOriginal[$letraNum][$num] = "X"; 
            $campoBotVisivel[$letraNum][$num] = "X";  
            $turnoPlayer = false; // Passa o turno para o bot
        } 
    } else {
        
        echo "/// TURNO DO BOT ///\n";
       
        echo "Bot está pensando...\n";
        sleep(3); 

        // Ataque do bot
        $botAtacou = false;
        $tentativasBot = 0;
        while(!$botAtacou && $tentativasBot < 100) { // Previne loop infinito
            $tentativasBot++;
            $linhaBotAtk = random_int(1,10); 
            $colunaBotAtk = random_int(1,10);

            
            if (isset($campoPlayerJogo[$linhaBotAtk][$colunaBotAtk])) {
                if ($campoPlayerJogo[$linhaBotAtk][$colunaBotAtk] === "V") { 
                    echo "BOT ATIROU EM " . chr(64 + $linhaBotAtk) . $colunaBotAtk . " e ACERTOU seu barco!\n";
                    $campoPlayerJogo[$linhaBotAtk][$colunaBotAtk] = "O"; // Marca como atingido
                    $barcosPlayer--;
                    echo "Seus barcos restantes: $barcosPlayer\n";
                    echo exibeCampo($barcosPlayer);
                    echo "\n";

                    if ($barcosPlayer == 0) {
                        echo "*********************************************\n";
                        echo "DERROTA! O Bot afundou todos os seus barcos!\n";
                        echo "*********************************************\n";
                        
                        break;
                    }
                    
                } elseif ($campoPlayerJogo[$linhaBotAtk][$colunaBotAtk] === "~") {
                    echo "BOT ATIROU EM " . chr(64 + $linhaBotAtk) . $colunaBotAtk . " e errou (ÁGUA)!\n";
                    $campoPlayerJogo[$linhaBotAtk][$colunaBotAtk] = "X"; 
                    $botAtacou = true; 
                    $turnoPlayer = true; 
                } elseif ($campoPlayerJogo[$linhaBotAtk][$colunaBotAtk] === "O" || $campoPlayerJogo[$linhaBotAtk][$colunaBotAtk] === "X") {
                    
                    continue;
                } else {
                   
                     $botAtacou = true;
                     $turnoPlayer = true;
                }
            } else {
                // Coordenada gerada está fora do tabuleiro do jogador (improvável com random_int(1,10))
                // mas é uma boa verificação se os limites forem dinâmicos.
                 continue;
            }
        }
        if ($tentativasBot >= 100 && !$botAtacou) {
            echo "Bot não conseguiu encontrar um local válido para atirar (improvável).\n";
            $turnoPlayer = true; // Passa turno para o jogador
        }
        

        if ($barcosPlayer == 0) break; 
    }
} 

if ($barcosBot == 0) {
    // Mensagem de vitória do jogador já mostrada
} elseif ($barcosPlayer == 0) {
    // Mensagem de vitória do bot já mostrada
} else {
    echo "Jogo interrompido por outra razão.\n";
}

echo "Fim de jogo.\n";

?>