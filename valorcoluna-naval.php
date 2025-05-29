<?php

function substituirLetras($entrada) {
    $entrada = strtoupper($entrada); // Converte para maiúscula
    return ord($entrada) - ord('A') + 1; // Calcula a posição da letra
}



?>