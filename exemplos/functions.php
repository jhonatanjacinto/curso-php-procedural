<?php

$a = 10;
$b =& $a; // atribuição por cópia de valor

// & = passagem por referência de local na memória
function trocaValor(&$valor) {
    $valor = 70;
}

trocaValor($b);

echo "<br>";
echo "Valor de a: " . $a . "<br>";
echo "Valor de b: " . $b . "<br>";

$b = 20;
$a = 30;
echo "Valor de a: " . $a . "<br>";
echo "Valor de b: " . $b;

$animais = ["Leão", "Arara", "Tatu", "Macaco", "Elefante"];
echo "<pre>";
print_r($animais);
echo "</pre>";

sort($animais);

echo "<pre>";
print_r($animais);
echo "</pre>";