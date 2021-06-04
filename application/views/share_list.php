<div class="container-fluid share-list">
    <div class="row justify-content-center">
        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2 class="title">Compartir lista</h2>
                    <form action="<?= base_url('Lists/share_list') ?>" method="post">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="<?= form_error('email') ? 'form-control error' : 'form-control' ?>" value="<?= set_value('email') ? set_value('email') : '' ?>">
                            <?= form_error('email', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <input type="hidden" name="list_id" value="<?= $list_id ?>">
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-submit">Compartir Lista</button>
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