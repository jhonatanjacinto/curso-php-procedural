<?php

declare(strict_types=1); // obriga a tipagem de parâmetros e retorno

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Declaração de tipos escalares
function soma(int|float $a, int|float $b): int|float {
    return $a + $b;
}

echo soma(2, 3.75);