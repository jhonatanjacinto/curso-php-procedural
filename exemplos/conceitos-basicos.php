<?php 

/** Comentário de Bloco */
// Comentário de linha (estilo C)
# Comentário estilo bash

// Variáveis em PHP (CASE-SENSITIVE)
$nome = "Jhonatan";
$sobrenome = "Jacinto";
$idade = 32;
$salario = 5000.455686;
$isAposentado = false;
$linguagens = ["PHP", "JS", "TS"]; // Array de chave numérica

// Constantes com possibilidade de valor dinâmico, ou seja, vindo de outro lugar = define()
define("DIR_ROOT", $_SERVER["DOCUMENT_ROOT"]);
// const é utilizada para declarar constantes dentro de Classes (POO) ou com valores definidos diretamente no código
const PI = 3.14;

// echo "Olá mundo! <br>";
// print "Outra saída! <br>";
// printf("Olá, meu nome é %s %s, minha idade é %d anos e meu salario é %.2f", $nome, $sobrenome, $idade, $salario);
// $frase = sprintf("Olá, meu nome é %s %s, minha idade é %d anos e meu salario é %.2f", $nome, $sobrenome, $idade, $salario);
// echo $frase;

echo "Olá, meu nome é " . $nome . " " . $sobrenome . "<br>";
echo "Olá, meu nome $nome $sobrenome. \"Linguagem principal\": {$linguagens[0]}";

// HereDoc
$str_linguagens = join(", ", $linguagens);
$tabela = <<<MINHA_TABELA
    <table>
        <tr>
            <th>Nome completo</th>
            <th>Idade</th>
            <th>Salário</th>
            <th></th>
        </tr>
        <tr>
            <td>$nome $sobrenome</td>
            <td>$idade</td>
            <td>$salario</td>
            <td>$str_linguagens</td>
        </tr>
    </table>
MINHA_TABELA;
echo $tabela;

// Condicionais no PHP 
if ($idade > 10) {
    echo "Você tem mais de 10 anos";
} else if ($idade <= 10 && $idade >= 5) {
    echo "Você tem entre 5 e 10 anos";
} else {
    echo "Você tem 4 anos ou menos";
}

echo "<br>";

if ($idade > 10) :
    echo "Você tem mais de 10 anos";
elseif ($idade <= 10 && $idade >= 5) :
    echo "Você tem entre 5 e 10 anos";
else:
    echo "Você tem 4 anos ou menos";
endif;

// Switch case
switch ($idade) {
    case 10:
    case 9:
        echo "Você tem 10 ou 9 anos";
        break;
    case 7:
        echo "Você tem 7 anos";
        break;
    default:
        echo "Não sei que idade você tem";
        break;
}

switch ($idade) :
    case 10:
    case 9:
        echo "Você tem 10 ou 9 anos";
        break;
    case 7:
        echo "Você tem 7 anos";
        break;
    default:
        echo "Não sei que idade você tem";
        break;
endswitch;

echo "<br>";

// 8.1 = Match Expression
$frase = match ($idade) {
    10, 9, 8, 7, 6 => "Você tem entre 6 e 10 anos",
    3, 4, 5 => "Você tem entre 3 e 5 anos",
    default => "Você tem menos de 3 anos"
};
echo $frase;

// Repetição: while, do...while, for, foreach
// $numero = 0;
// while ($numero < 10) {
//     echo "$numero <br>";
//     $numero++;
// }

// $numero = 0;
// while ($numero < 10) :
//     echo "$numero <br>";
//     $numero++;
// endwhile;

echo "<br>";

$numero = 1;
do {
    echo "$numero <br>"; // executa o bloco uma única vez
} while($numero < 0);

for ($i = 0; $i < count($linguagens); $i++) {
    echo "#$i - " . $linguagens[$i] . "<br>";
}

echo "<br>";
// foreach é usado para percorrer arrays
foreach ($linguagens as $indice => $linguagem) {
    echo "#$indice - " . $linguagem . "<br>";
}
// foreach () :
// endforeach;

// isset($variavel): verifica se a variável existe
// unset($variavel): remove a variável da memória
// empty($variavel): verifica se a variável está vazia (falsey values)
// var_dump(isset($sobrenome)); // true
// unset($sobrenome);
// var_dump(isset($sobrenome)); // false

// Falsy Values: false, 0, 0.0, "", '', null, [], "0"
$produto = "Jhonatan";
var_dump(isset($produto)); // true
var_dump(empty($produto)); // false
var_dump($produto === true); // false