<div class="container-fluid new-list">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2 class="title">Nueva lista</h2>
                    <form action="create" method="post">
                        <div class="form-group">
                            <label for="name">Nombre de la lista</label>
                            <input type="text" name="name" id="name" class="<?= form_error('name') ? 'form-control error' : 'form-control' ?>">
                            <?= form_error('name', '<p class="text-danger">', '</p>'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="descrip">Descripción</label>
                            <textarea name="descrip" id="descrip" class="form-control" rows="8"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-submit">Crear lista</button>
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