<div class="container-fluid new-task">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-8">
                    <h2 class="title">Nueva subtarea</h2>
                    <form action="<?= base_url('Subtask/create_subtask') ?>" method="post">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="<?= form_error('name') ? 'form-control error' : 'form-control' ?>">
                            <?= form_error('name', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="descrip">Descripción</label>
                            <textarea name="descrip" id="descrip" class="form-control" rows="8"></textarea>
                        </div>
    
                        <div class="form-group">
                            <label for="state">Seleccionar estado de la tarea</label>
                            <select name="state" id="state" class="form-control">
                                <option value="0">Incompleto</option>
                                <option value="1">Completo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-submit">Crear</button>
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