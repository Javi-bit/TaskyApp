<div class="container-fluid log-in">
    <div class="row">
        <main class="col">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2 class="title">Iniciar sesión</h2>
                    <form action="<?= base_url('User/log_in') ?>" method="post">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="<?= form_error('email') ? 'form-control error' : 'form-control' ?>" value="<?= set_value('email') ? set_value('email') : '' ?>">
                            <?= form_error('email', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="pass">Contraseña</label>
                            <input type="password" name="pass" id="pass" class="<?= form_error('pass') ? 'form-control error' : 'form-control' ?>" value="<?= set_value('pass') ? set_value('pass') : '' ?>">
                            <?= form_error('pass', '<p class="text-danger">', '</p>'); ?>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-submit">Ingresar</button>
                        </div>
                    </form>

                    <?php if(isset($msg)) { ?>
                        <div class="alert alert-<?= $alert ?>">
                            <?= $msg ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
</div>