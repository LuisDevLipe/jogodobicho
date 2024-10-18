<?php
function sanitize($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
// validar nome 
function validarNome($name)
{
    $name = sanitize($name);
    if (strlen($name) < 15 || strlen($name) > 80) {
        header("Location: /jogodobicho/pages/cadastro/cadastro.php?error=nome");
        exit();
    }
}
// validar cpf
function validarCPF($cpf)
{
    $cpf = sanitize($cpf);


    if (!checkIfHasErrors($cpf)) {
        header("Location: /jogodobicho/pages/cadastro/cadastro.php?error=cpf");
        exit();
    }

    $PESOS1 = [10, 9, 8, 7, 6, 5, 4, 3, 2];
    $PESOS2 = [11, 10, 9, 8, 7, 6, 5, 4, 3, 2];

    $digito1 = arrayCPF(substr($cpf, 0, 9));
    $digito2 = arrayCPF(substr($cpf, 0, 10));

    $digito1Verificado = calculoDigito($digito1, $PESOS1);
    $digito2Verificado = calculoDigito($digito2, $PESOS2);

    if (strlen($cpf) == 11) {
        if (comparaDigitos($cpf, $digito1Verificado, $digito2Verificado)) {
            // successStyle(el); // Implement success style if needed
            return true;
        } else {
            // jsToastMessage("CPF inválido", "error"); // Implement toast message if needed
            // errorStyle(el); // Implement error style if needed
            return false;
        }
    }
}

function arrayCPF($cpf)
{
    return str_split($cpf);
}

function calculoDigito($cpf, $pesos)
{
    $somatoria = array_reduce(array_map(function ($num, $i) use ($pesos) {
        return (int)$num * (int)$pesos[$i];
    }, $cpf, array_keys($cpf)), function ($acc, $total) {
        return $acc + $total;
    }) % 11;

    $resultado = 11 - $somatoria;
    return $resultado > 9 ? 0 : $resultado;
}

function comparaDigitos($entrada, $calculoDigito1, $calculoDigito2)
{
    return $entrada[9] == $calculoDigito1 && $entrada[10] == $calculoDigito2;
}

function checkIfHasErrors($cpf)
{
    // limpar o cpf
    $cpf = preg_replace('/\D/', '', $cpf);

    // verificar se o cpf nao e uma string vazia
    if ($cpf === "") {
        // jsToastMessage("CPF não pode ser vazio", "error"); // Implement toast message if needed
        return false;
    }

    // verificar se o cpf contem somente numeros
    if (!preg_match('/^[0-9]+$/', $cpf)) {
        // jsToastMessage("CPF deve conter apenas números", "error"); // Implement toast message if needed
        return false;
    }

    if (strlen($cpf) != 11) {
        // jsToastMessage("CPF deve conter 11 dígitos", "error"); // Implement toast message if needed
        return false;
    }

    // check if all numbers are the same
    if (count(array_unique(str_split($cpf))) === 1) {
        // jsToastMessage("CPF inválido", "error"); // Implement toast message if needed
        return false;
    }

    return true;
}

echo validarCPF("12345678909");

function validarUsername($username)
{
    if (strlen($username) !== 6) {
        return false;
    }
    if (!ctype_alpha($username)) {
        return false;
    }
    return true;
}

// senha deve conter exatos 8 caracteres alfabeticos
function validarSenha($password)
{
    if (strlen($password) !== 8) {
        return false;
    }
    if (!ctype_alpha($password)) {
        return false;
    }
    return true;
}