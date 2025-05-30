
<?php
function separarLetrasNumerosManual($posicao) {
    $letras = '';
    $numeros = '';

    // Adicionar uma verificação para $posicao não ser nula ou vazia
    if (!is_string($posicao) || $posicao === '') { // Garante que é uma string e não vazia
        return ['letras' => '', 'numeros' => ''];
    }

    for ($i = 0; $i < strlen($posicao); $i++) {
        if (ctype_alpha($posicao[$i])) {
            $letras .= $posicao[$i];
        } elseif (ctype_digit($posicao[$i])) {
            $numeros .= $posicao[$i];
        }
    }
    return ['letras' => $letras, 'numeros' => $numeros];
}

// Deve aceitar o parâmetro $posicao
function transferLetra($posicao){ // <<< ADICIONE $posicao AQUI
    $resultado = separarLetrasNumerosManual($posicao); // Agora $posicao é o parâmetro recebido
    $letra = $resultado['letras'];
    return $letra;
}

// Deve aceitar o parâmetro $posicao e corrigir o retorno
function transferNum($posicao){   // <<< ADICIONE $posicao AQUI
    $resultado = separarLetrasNumerosManual($posicao); // Agora $posicao é o parâmetro recebido
    $numerosRetornados = $resultado['numeros']; // Use um nome de variável mais claro
    return $numerosRetornados;                    // <<< CORRIJA A VARIÁVEL DE RETORNO
}
?>