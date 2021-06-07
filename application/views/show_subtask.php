<div class="container-fluid show-subtask">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card mb-3">
                        <h3 class="card-header"><?= $subtask->name ?></h3>
                        <div class="card-body">
                            <h4 class="card-title">Descripción</h4>
                            <p class="card-text"><?= $subtask->descrip ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><span>Estado:</span> <?= $subtask->state ?></li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?= base_url().'Subtask/form_edit_subtask/'.$subtask->id ?>" class="btn btn-dark">Editar</a>
                            <a href="<?= base_url().'Subtask/delete_subtask/'.$subtask->id ?>" class="btn">Eliminar</a>
                        </div>
                    </div>
                    
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