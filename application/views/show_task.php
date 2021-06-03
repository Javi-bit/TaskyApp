<div class="container-fluid show-task">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card mb-3">
                        <h3 class="card-header"><?= $task->name ?></h3>
                        <div class="card-body">
                            <h4 class="card-title">Descripción</h4>
                            <p class="card-text"><?= $task->descrip ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><span>Vencimiento:</span> <?= $task->expir ?></li>
                            <li class="list-group-item"><span>Recordatorio:</span> <?= $task->memo ?></li>
                            <li class="list-group-item"><span>Prioridad:</span> <?= $task->priori ?></li>
                            <li class="list-group-item"><span>Estado:</span> <?= $task->state ?></li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?= base_url().'Task/form_edit_task/'.$task->id ?>" class="btn btn-warning">Editar</a>
                            <a href="<?= base_url().'Task/delete_task/'.$task->id  ?>" class="btn">Eliminar</a>
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