<form method="POST">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="first_name">Primeiro nome <span>*</span></label>
                <input type="text" class="form-control" name="first_name" placeholder="Ex.: João" required value="<?php echo isset($employee) ? $employee->first_name : ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label for="last_name">Sobrenome <span>*</span></label>
                <input type="text" class="form-control" name="last_name" placeholder="Ex.: da Silva" required value="<?php echo isset($employee) ? $employee->last_name : ''; ?>">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group mb-3">
                <label for="email">E-mail <span>*</span></label>
                <input type="email" class="form-control" name="email" placeholder="Ex.: joao@gmail.com" required value="<?php echo isset($employee) ? $employee->email : ''; ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="last_name">CPF (Apenas números) <span>*</span></label>
                <input type="number" class="form-control" name="cpf" required value="<?php echo isset($employee) ? $employee->cpf : ''; ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="last_name">RG</label>
                <input type="text" class="form-control" name="rg" value="<?php echo isset($employee) ? $employee->rg : ''; ?>">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Gravar</button>
</form>