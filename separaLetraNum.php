<?php
function separarLetrasNumerosManual($posicao) {
    $letras = '';
    $numeros = '';

    for ($i = 0; $i < strlen($posicao); $i++) {
        if (ctype_alpha($posicao[$i])) {
            $letras .= $posicao[$i]; // Adiciona à string de letras
        } elseif (ctype_digit($posicao[$i])) {
            $numeros .= $posicao[$i]; // Adiciona à string de números
        }
    }

    return ['letras' => $letras, 'numeros' => $numeros];
}

function transferLetra(){

$resultado = separarLetrasNumerosManual($entrada);

$letra = $resultado['letras'];

return $letra;
}

function transferNum(){

$resultado = separarLetrasNumerosManual($entrada);

$letra = $resultado['numeros'];

return $numero;
}
?>
