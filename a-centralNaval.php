<?php

require_once "a-separaPosicao.php";
require_once "a-posicionar.php"; // Garanta que este não executa pedirPosicoes por si só
require_once "a-matrizbase.php";
require_once "a-letraPraNum.php"; // Assumindo que este contém substituirLetras e não tem duplicatas de matrizbase.php
require_once "a-posicionarBot.php";

/////////////////////////////////////////
// FUNÇÕES DO MENU (podem ficar aqui ou em um arquivo separado)
/////////////////////////////////////////

function exibirMenu() {
    echo "\n=========================================\n";
    echo "      BEM-VINDO À BATALHA NAVAL!      \n";
    echo "=========================================\n";
    echo "1. Iniciar Novo Jogo\n";
    echo "2. Ver Regras (Exemplo)\n";
    echo "3. Sair\n";
    echo "-----------------------------------------\n";
}

function mostrarRegras() {
    echo "\n--- REGRAS DO JOGO ---\n";
    echo "1. Você e o computador posicionarão 10 barcos (1x1) em um tabuleiro 10x10.\n";
    echo "2. As posições são indicadas por LetraNumero (ex: A1, J10).\n";
    echo "3. Em seu turno, escolha uma coordenada para atacar.\n";
    echo "   - 'O' indica um acerto em um barco.\n";
    echo "   - 'X' indica um tiro na água.\n";
    echo "4. O primeiro a afundar todos os barcos do oponente vence!\n";
    echo "----------------------\n";
    readline("Pressione Enter para voltar ao menu..."); // Pausa para o usuário ler
}

/////////////////////////////////////////
// LÓGICA PRINCIPAL DO JOGO
/////////////////////////////////////////

while (true) { 
    exibirMenu();
    $escolha = readline("Escolha uma opção: ");

    switch ($escolha) {
        case '1': // Iniciar Novo Jogo
            echo "Iniciando novo jogo...\n";

            
            $campoBotVisivel = campoBot();      
            $campoBotOriginal = posicaoBot(campoBot()); 

            $campoPlayer = campoPlayer();     
            exibeCampo($campoPlayer);
            echo "\nEsse é seu campo! Insira dentro dele seus barcos respeitando o formato das posições, sendo letra e numero( EXEMPLO: A4 ) PS: A letra V representa seus barcos. \n";
            $campoPlayerJogo = pedirPosicoes($campoPlayer); 

            $barcosPlayer = 10;
            $barcosBot = 10;
            $turnoPlayer = true; 

          
            while ($barcosPlayer > 0 && $barcosBot > 0) {
                if ($turnoPlayer) {
                    echo "\n/// SEU TURNO - CARREGAR OS CANHÕES /// \n";
                    sleep(1);
                    echo "Este é o campo inimigo :\n";
                    exibeCampo($campoBotVisivel);

                    sleep(2);
                    $posicaoAtaque = readline("Insira a posição que deseja atacar (ex: A5) --:\n");
                    $posicaoAtaque = strtoupper(trim($posicaoAtaque));

                    if (!preg_match('/^[A-J]([1-9]|10)$/', $posicaoAtaque)) {
                        echo "Entrada inválida. Use o formato LetraNumero (ex: A1, J10).\n";
                        continue; // Volta para o início do turno do jogador
                    }

                    $letraAtaque = transferLetra($posicaoAtaque);
                    $numStrAtaque = transferNum($posicaoAtaque);

                    if (empty($letraAtaque) || empty($numStrAtaque)) { // Validação extra simples
                        echo "Formato de posição inválido ao separar. Tente novamente.\n";
                        continue;
                    }

                    $letraNumAtaque = substituirLetras($letraAtaque);
                    $numAtaque = (int)$numStrAtaque;

                    if ($letraNumAtaque < 1 || $letraNumAtaque > 10 || $numAtaque < 1 || $numAtaque > 10) {
                        echo "Posição fora do tabuleiro!\n";
                        continue;
                    }

                    $alvo = $campoBotOriginal[$letraNumAtaque][$numAtaque];

                    if ($alvo === "O" || $alvo === "X") {
                        echo "Esta posição já foi atacada! Tente outra.\n";
                        continue;
                    } elseif ($alvo === "V") {
                        echo "Analisando poder de fogo...\n";
                        sleep(1); 
                        echo "FOGO! Acertou um barco inimigo!\n";
                        $campoBotOriginal[$letraNumAtaque][$numAtaque] = "O";
                        $campoBotVisivel[$letraNumAtaque][$numAtaque] = "O";
                        $barcosBot--;
                        echo "Barcos inimigos restantes: $barcosBot\n";
                        if ($barcosBot == 0) {
                            exibeCampo($campoBotVisivel);
                            echo "\n*********************************************\n";
                            echo "PARABÉNS! Você afundou todos os barcos inimigos!\n";
                            echo "*********************************************\n";
                            break; 
                        }
                    } elseif ($alvo === "~") {
                        echo "PROCESSANDO TIRO...\n";
                        sleep(1);
                        echo "ÁGUA! Nenhum barco na região.\n";
                        $campoBotOriginal[$letraNumAtaque][$numAtaque] = "X";
                        $campoBotVisivel[$letraNumAtaque][$numAtaque] = "X";
                        $turnoPlayer = false; 
                    }
                } else {
                    echo "\n/// TURNO DO BOT ///\n";
                    echo "Bot está pensando...\n";
                    sleep(rand(2,4)); 

                    $botAtacou = false;
                    $tentativasBot = 0;
                    $maxTentativasBot = 50; 

                    while (!$botAtacou && $tentativasBot < $maxTentativasBot) {
                        $tentativasBot++;
                        $linhaBotAtk = random_int(1, 10);
                        $colunaBotAtk = random_int(1, 10);

                        if (isset($campoPlayerJogo[$linhaBotAtk][$colunaBotAtk])) {
                            $celulaAlvoBot = $campoPlayerJogo[$linhaBotAtk][$colunaBotAtk];
                            $coordAlvoBot = chr(64 + $linhaBotAtk) . $colunaBotAtk; // Converte linha para Letra

                            if ($celulaAlvoBot === "V") { 
                                echo "BOT ATIROU EM " . $coordAlvoBot . " e ACERTOU seu barco!\n";
                                $campoPlayerJogo[$linhaBotAtk][$colunaBotAtk] = "O";
                                $barcosPlayer--;
                                echo "Seus barcos restantes: $barcosPlayer\n";
                                exibeCampo($campoPlayerJogo); 
                                if ($barcosPlayer == 0) {
                                    echo "\n*********************************************\n";
                                    echo "DERROTA! O Bot afundou todos os seus barcos!\n";
                                    echo "*********************************************\n";
                                    break; // Termina o loop do jogo
                                }
                                $botAtacou = true; 
                               
                            } elseif ($celulaAlvoBot === "~") { 
                                echo "BOT ATIROU EM " . $coordAlvoBot . " e errou (ÁGUA)!\n";
                                $campoPlayerJogo[$linhaBotAtk][$colunaBotAtk] = "X";
                                $botAtacou = true;
                                $turnoPlayer = true; 
                            } elseif ($celulaAlvoBot === "O" || $celulaAlvoBot === "X") {
                                
                                continue;
                            }
                        }
                    }
                    if (!$botAtacou && $tentativasBot >= $maxTentativasBot) {
                        // Isso pode acontecer se o bot só tiver posições já atacadas para escolher
                        // ou se houver poucos barcos restantes e ele "não os encontrar" rapidamente.
                        echo "Bot não conseguiu realizar um novo ataque válido desta vez.\n";
                        $turnoPlayer = true; // Devolve o turno ao jogador para evitar loop
                    }

                    if ($barcosPlayer == 0) break; 
                }
            } 

            // ----- FIM DA LÓGICA ORIGINAL DO JOGO -----
            echo "\nFim de jogo.\n";
            readline("Pressione Enter para voltar ao menu principal...");
            break; // Sai do case '1' e volta para o loop do menu

        case '2': // Ver Regras
            mostrarRegras();
            break; // Volta para o loop do menu

        case '3': // Sair
            echo "Obrigado por jogar! Até a próxima.\n";
            exit; // Termina o script

        default:
            echo "Opção inválida. Tente novamente.\n";
            sleep(1);
            break;
    }
} 
?>