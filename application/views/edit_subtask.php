<div class="container-fluid edit-subtask">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-8">
                    <h2 class="title">Nueva subtarea</h2>
                    <form action="<?= base_url('Subtask/update_subtask') ?>" method="post">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="<?= form_error('name') ? 'form-control error' : 'form-control' ?>" value="<?= set_value('name') ? set_value('name') : $subtask->name ?>">
                            <?= form_error('name', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="descrip">Descripción</label>
                            <textarea name="descrip" id="descrip" class="form-control" rows="8"><?= set_value('descrip') ? set_value('descrip') : $subtask->descrip ?></textarea>
                        </div>
    
                        <div class="form-group">
                            <label for="state">Seleccionar estado de la tarea</label>
                            <select name="state" id="state" class="form-control">
                                <option value="0">Incompleta</option>
                                <option value="1">Completa</option>
                            </select>
                        </div>

                        <input type="hidden" name="id" value="<?= $subtask->id ?>">

                        <div class="form-group">
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

<script>
    (function(){

        var state = document.getElementById('state').options;

        for ( i=0; i< state.length; i++)
        {
            if(state[i].value == <?= $subtask->state ?>) {
                state[i].selected = "true";
            }
        }

    })();
</script>