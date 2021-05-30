<div class="container-fluid change_pass">
    <div class="row">
        <main class="col">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2 class="title">Cambiar contraseña</h2>
                    <form action="change_pass" method="post">
                        <div class="form-group">
                            <label for="old_pass">Contraseña anterior</label>
                            <input type="password" name="old_pass" id="old_pass" class="<?= form_error('old_pass') ? 'form-control error' : 'form-control' ?>">
                            <?= form_error('old_pass', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="new_pass">Contraseña nueva</label>
                            <input type="password" name="new_pass" id="new_pass" class="<?= form_error('new_pass') ? 'form-control error' : 'form-control' ?>">
                            <?= form_error('new_pass', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-submit">Aceptar</button>
                        </div>
                    </form>
                    
                    <?php if(isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-<?= $_SESSION['alert'] ?>">
                            <?= $_SESSION['msg'] ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
</div>