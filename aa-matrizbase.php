 <?php


function exibeCampo($campo)
{
    echo "\n";
    
    
    echo "  "; 
    for ($j = 1; $j <= 10; $j++) {
        echo str_pad($j, 2, " ", STR_PAD_LEFT) . " "; 
    }
    echo "\n";

    for ($i = 1; $i <= 10; $i++) { 
        echo $campo[$i][0] . " "; 
        for ($j = 1; $j <= 10; $j++) {
            echo " " . $campo[$i][$j] . " "; 
        }
        echo "\n";
    }
    echo "\n";
}

function campoPlayer()
{
    $campoPlayer = array_fill(0, 11, array_fill(0, 11, "~")); 

    $campoPlayer[0][0]= " ";

    $letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    for ($i = 0; $i < 10; $i++) {
        $campoPlayer[$i + 1][0] = $letras[$i]; 
    }

    for ($j = 0; $j < 10; $j++) {
        $campoPlayer[0][$j + 1] = (string)($j + 1); 
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
