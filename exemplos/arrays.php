<?php

$nomes = ["Paulo", "Maria", "João", "Pedro", "Ana"];
$nomes2 = ["Carla", "José", "Marcos", "Lucas", "Mateus", "Tiago", "Judas", "Judas Tadeu"];

$listaCompleta = [...$nomes, ...$nomes2]; // spread operator

echo "<pre>";
print_r($listaCompleta);
echo "</pre>";