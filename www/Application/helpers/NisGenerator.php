<?php

namespace Application\helpers;

class NisGenerator
{
  const weights = array(3, 2, 9, 8, 7, 6, 5, 4, 3, 2);

  /**
  * Gera um NIS válido automaticamente.
  *
  * @return   int
  */
  public static function generate()
  {

    // Passo 1: Gerar NIS aleatório de 10 dígitos
    $r_nis = [];
    for ($i = 0; $i < 10; $i++) {
      $r_nis[] = rand(0, 9);
    }

    // Passo 2: Multiplicar cada dígito pelos pesos correspondentes e somar os resultados
    $sum = 0;
    for ($i = 0; $i < 10; $i++) {
        $sum += $r_nis[$i] * self::weights[$i]; 
    }

    // Passo 3: Calcular o módulo 11 da soma
    $mod = $sum % 11;

    // Passo 4: Calcular a diferença entre 11 e o módulo
    $check_digit = 11 - $mod;

    // Caso o dígito seja 10 ou 11, ajusta para 0
    if ($check_digit >= 10) {
      $check_digit = 0;
    }

    // Passo 5: Adicionar o dígito verificador ao final do NIS gerado
    $r_nis[10] = $check_digit;

    // Retorna o NIS como string
    return implode('', $r_nis);
  }
}