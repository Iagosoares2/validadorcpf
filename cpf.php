<?php

function validar_cpf($cpf) {

    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }
    
    if (preg_match('/^(\d)\1+$/', $cpf)) {
        return false;
    }
    
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += (int) substr($cpf, $i, 1) * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = $resto < 2 ? 0 : 11 - $resto;
    
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += (int) substr($cpf, $i, 1) * (11 - $i);
    }
    $soma += $digito1 * 2;
    $resto = $soma % 11;
    $digito2 = $resto < 2 ? 0 : 11 - $resto;
    
    if ($cpf[9] != $digito1 || $cpf[10] != $digito2) {
        return false;
    }
    
    return true;
}

if (validar_cpf('123.456.789-09')) {
    echo 'CPF válido!';
} else {
    echo 'CPF inválido!';
}