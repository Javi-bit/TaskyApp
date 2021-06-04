<div class="container-fluid edit-user">
    <div class="row">
        <main class="col">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2 class="title">Editar cuenta</h2>
                    <form action="<?= base_url('User/update_user') ?>" method="post">
                        <div class="form-group">
                            <label for="username">Nombre de Usuario</label>
                            <input type="text" name="username" id="username" class="<?= form_error('username') ? 'form-control error' : 'form-control' ?>" value="<?= set_value('username') ? set_value('username') : $_SESSION['username']  ?>">
                            <?= form_error('username', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="<?= form_error('email') ? 'form-control error' : 'form-control' ?>" value="<?= set_value('email') ? set_value('email') : $_SESSION['email'] ?>">
                            <?= form_error('email', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <a href="<?= base_url('User/form_change_pass') ?>" class="btn btn-light">Cambiar contraseña</a>
                            <button type="submit" class="btn btn-warning btn-submit">Actualizar</button>
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