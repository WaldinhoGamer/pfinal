<?php

function substituirLetras($letra) {
    $letra = strtoupper("$letra"); // Converte para maiúscula
    return ord($letra) - ord('A') + 1; // Calcula a posição da letra
}



?>