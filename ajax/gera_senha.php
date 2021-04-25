<?php

/**
* Fun��o para gerar senhas aleat�rias
*
* @author    Thiago Belem <contato@thiagobelem.net>
*
* @param integer $tamanho Tamanho da senha a ser gerada
* @param boolean $maiusculas Se ter� letras mai�sculas
* @param boolean $numeros Se ter� n�meros
* @param boolean $simbolos Se ter� s�mbolos
*
* @return string A senha gerada
*/


function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{

// Caracteres de cada tipo
$lmin = 'abcdefghijklmnopqrstuvwxyz';
$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$num = '1234567890';
$simb = '!@#$%*-';

// Vari�veis internas
$retorno = '';
$caracteres = '';

// Agrupamos todos os caracteres que poder�o ser utilizados

$caracteres .= $lmin;
if ($maiusculas) $caracteres .= $lmai;
if ($numeros) $caracteres .= $num;
if ($simbolos) $caracteres .= $simb;
// Calculamos o total de caracteres poss�veis
$len = strlen($caracteres);
for ($n = 1; $n <= $tamanho; $n++) {
// Criamos um n�mero aleat�rio de 1 at� $len para pegar um dos caracteres
$rand = mt_rand(1, $len);
// Concatenamos um dos caracteres na vari�vel $retorno
$retorno .= $caracteres[$rand-1];
}

return $retorno;
}

?>
