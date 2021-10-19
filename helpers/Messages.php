<?php

class Messages
{
    static private $constants = [
        'v1' => 'O campo Primeiro nome é obrigatório',
        'v2' => 'O campo Sobrenome é obrigatório',
        'v3' => 'O campo Email é obrigatório e deve conter um e-mail válido',
        'v4' => 'O campo CPF é obrigatório e deve conter um CPF válido',
    
        'db1' => 'Ocorreu um erro ao tentar cadastrar estes dados!',
    
        's1' => 'Registro cadastrado com sucesso!',
        's2' => 'Registro atualizado com sucesso!',
        's3' => 'Registro excluido com sucesso!',

        '404' => '404 - Registro não localizado!'
    ];

    static function showErrorIfExists()
    {
        if (isset($_GET['error'])) {
            // Obtem a string de chaves de erros na URL
            $errors = filter_input(INPUT_GET, 'error', FILTER_DEFAULT);

            // Transforma em um Array
            $errors = explode(',', $errors);

            // Se o array tiver apenas um item, imprime como erro simples
            if (count($errors) === 1) {
                if (array_key_exists($errors[0], SELF::$constants)) {
                    echo '<div class="alert alert-danger">';
                    echo SELF::$constants[$errors[0]];
                    echo '</div>';
                }
            } else if (count($errors) > 1) {
                foreach ($errors as $error) {
                    echo '<div class="alert alert-danger">';
                    if (array_key_exists($error, SELF::$constants)) {
                        echo SELF::$constants[$error] . "<br>";
                    }
                    echo '</div>';
                }
            }
        }
    }

    static function showSuccessIfExists()
    {
        if (isset($_GET['success'])) {
            // Obtem a string de chaves de sucesso na URL
            $success = filter_input(INPUT_GET, 'success', FILTER_DEFAULT);

            if (array_key_exists($success, SELF::$constants)) {
                echo '<div class="alert alert-success">';
                echo SELF::$constants[$success];
                echo '</div>';
            }
        }
    }
}
