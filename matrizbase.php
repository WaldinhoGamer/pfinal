 <?php

function exibeCampo($campo)
{
    echo "\n";
    
    // Adiciona os números da coluna no topo
    echo "  "; // Espaço para o canto
    for ($j = 1; $j <= 10; $j++) {
        echo str_pad($j, 2, " ", STR_PAD_LEFT) . " "; // str_pad para alinhar
    }
    echo "\n";

    for ($i = 1; $i <= 10; $i++) { // Começa em 1 para pular a linha de números e a coluna de letras
        echo $campo[$i][0] . " "; // Mostra a letra da linha
        for ($j = 1; $j <= 10; $j++) {
            echo " " . $campo[$i][$j] . " "; // Mostra o conteúdo da célula
        }
        echo "\n";
    }
    echo "\n";
}

function campoPlayer()
{
    $campoPlayer = array_fill(0, 11, array_fill(0, 11, "~")); // 0 para labels, 1-10 para jogo

    $campoPlayer[0][0]= " "; // Canto superior esquerdo

    $letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    for ($i = 0; $i < 10; $i++) {
        $campoPlayer[$i + 1][0] = $letras[$i]; // Linhas 1-10, coluna 0
    }

    for ($j = 0; $j < 10; $j++) {
        $campoPlayer[0][$j + 1] = (string)($j + 1); // Colunas 1-10, linha 0
    }
    return $campoPlayer;
}

function campoBot()
{
    // CORREÇÃO AQUI: usar $campoBot consistentemente
    $campoBot = array_fill(0, 11, array_fill(0, 11, "~")); // 0 para labels, 1-10 para jogo

    $campoBot[0][0] = " "; // Canto superior esquerdo

    $letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    for ($i = 0; $i < 10; $i++) {
        $campoBot[$i + 1][0] = $letras[$i]; // Linhas 1-10, coluna 0
    }

    for ($j = 0; $j < 10; $j++) {
        $campoBot[0][$j + 1] = (string)($j + 1); // Colunas 1-10, linha 0
    }
    return $campoBot;
}

?>
