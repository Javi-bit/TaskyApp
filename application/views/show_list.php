<div class="container-fluid show-list">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card mb-3">
                        <h3 class="card-header"><?= $list->name ?></h3>
                        <div class="card-body">
                            <h4 class="card-title">Descripción</h4>
                            <p class="card-text"><?= $list->descrip ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('Lists/form_share_list/'.$list->id) ?>" class="btn btn-warning">Compartir lista</a>
                            <a href="<?= base_url('Lists/form_edit_list/'.$list->id) ?>" class="btn btn-dark">Editar</a>
                            <a href="<?= base_url('Lists/delete_list/'.$list->id) ?>" class="btn delete">Eliminar</a>
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