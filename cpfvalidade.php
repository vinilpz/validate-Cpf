<?php

function validateCPF($number)

{

    // Retirar qualquer tipo de máscara ou pontuação do número do CPF

    $cpf = preg_replace('/[^0-9]/', "", $number); 

    
    // Verificar se o cpf tem 11 dígitos
    
    if (strlen($cpf) != 11) {
        return false;
    }
    
    // Verificar se os 11 dígitos não são iguais

    if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
        return false;
    }

    // Verificação das regras matemáticas

    $sum = 0;
    $number_to_multiplicate = 10;
    
    for ($i = 0; $i < 9; $i++) {
        $sum += $cpf[$i] * ($number_to_multiplicate--);
    }
    
    $result = (($sum * 10) % 11);

    $number_quantity_to_loop = [9, 10];
    foreach ($number_quantity_to_loop as $item) {

        $sum = 0;
        $number_to_multiplicate = $item + 1;

        for ($i = 0; $i < $item; $i++) {
            $sum += $cpf[$i] * ($number_to_multiplicate--);
        }
        $result = (($sum * 10) % 11);
        if ($cpf[$item] != $result){
            return false;
        }
    }
    
    return true;
    
}