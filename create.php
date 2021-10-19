<?php

require_once('./bootstrap.php');

// Verifica se a página foi acessada via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do request
    $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_SPECIAL_CHARS);

    $errorBag = [];

    if (empty($firstName)) {
        $errorBag[] = 'v1';
    }

    if (empty($lastName)) {
        $errorBag[] = 'v2';
    }

    if (empty($email)) {
        $errorBag[] = 'v3';
    }

    if (empty($cpf)) {
        $errorBag[] = 'v4';
    }

    /**
     * Verifica se houve algum erro
     * Caso exista algum erro, redireciona o usuário
     */
    if (count($errorBag) > 0) {
        header('Location: create.php?error=' . implode(',', $errorBag));
        exit;
    }

    $query = 'INSERT INTO employees (first_name, last_name, email, cpf, rg) VALUES (?, ?, ?, ?, ?)';
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $firstName, $lastName, $email, $cpf, $rg);
    if ($stmt->execute()) {
        header('Location: index.php?success=s1');
    } else {
        header('Location: index.php?error=db1');
    }
}

include_once('./layout/header.php');

?>

<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md">

                <a href="/" class="btn btn-primary">Voltar para a listagem</a>
                <hr>

                <h1>Cadastrar funcionário</h1>

                <hr>

                <?php include_once('./partials/form.php') ?>

            </div>
        </div>
    </div>
</section>

<script src="./assets/js/scripts.js"></script>

<?php

include_once('./layout/footer.php');

?>
