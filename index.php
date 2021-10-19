<?php

require_once('./bootstrap.php');
include_once('./layout/header.php');

?>

<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md">

                <a href="create.php" class="btn btn-success">Cadastrar Novo</a>
                <hr>

                <h1>Funcionários cadastrados</h1>

                <hr>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome Completo</th>
                                <th>CPF</th>
                                <th>RG</th>
                                <th>E-mail</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "
                                    SELECT
                                        id,
                                        CONCAT(first_name, ' ', last_name) as full_name,
                                        cpf,
                                        IFNULL(rg, '---') as rg,
                                        email
                                    FROM
                                        employees
                            ";
                            $employees = $db->query($query);

                            ?>
                            <?php if ($employees): ?>
                                <?php while($employee = $employees->fetch_object()): ?>
                                    <tr>
                                        <th><?php echo $employee->id; ?></th>
                                        <td><?php echo $employee->full_name; ?></td>
                                        <td><?php echo $employee->cpf; ?></td>
                                        <td><?php echo $employee->rg; ?></td>
                                        <td><?php echo $employee->email; ?></td>
                                        <td width="140">
                                            <a href="update.php?id=<?php echo $employee->id ; ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="#" onclick="deleteEmployee(event, '<?php echo $employee->id ; ?>')" class="btn btn-danger btn-sm">Excluir</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-info mb-0">Ainda não há registros cadastrados!</div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="./assets/js/scripts.js"></script>

<?php

include_once('./layout/footer.php');

?>
