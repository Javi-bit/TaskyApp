<div class="container-fluid new-task">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card mb-3">
                        <h3 class="card-header">Nombre de la subtarea</h3>
                        <div class="card-body">
                            <h4 class="card-title">Descripción</h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><span>Estado:</span> Incompleta</li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?= base_url().'Subtask/edit/task_id' ?>" class="btn btn-warning">Editar</a>
                            <a href="<?= base_url().'Subtask/delete/task_id' ?>" class="btn">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>