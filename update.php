<?php

require_once('./bootstrap.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php?error=404');
    exit;
}

// Verifica se há um registro referente ao ID informado
$query = "SELECT * FROM employees WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();

$employee = $stmt->get_result()->fetch_object();

if (empty($employee)) {
    header('Location: index.php?error=404');
    exit;
}

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

    // Caso exista algum erro, redireciona o usuário com o errorBag na URL
    if (count($errorBag) > 0) {
        header('Location: create.php?error=' . implode(',', $errorBag));
        exit;
    }

    $query = 'UPDATE employees SET first_name = ?, last_name = ?, email = ?, cpf = ?, rg = ? WHERE id = ?';
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssssi', $firstName, $lastName, $email, $cpf, $rg, $id);
    if ($stmt->execute()) {
        header('Location: index.php?success=s2');
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

                <h1>Editar funcionário</h1>

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
