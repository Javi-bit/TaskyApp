<div class="container-fluid lists-list">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <h2 class="title">
                Listas
            </h2>
            <ul class="lists">
                <?php  foreach ($lists as $i) { ?>
                <li class="list-item">
                    <a href="<?= base_url('Task/list_tasks/'.$i->id) ?>" class="btn"><?= $i->name?></a>
                    <a href="<?= base_url('Lists/form_share_list/'.$i->id) ?>" class="btn btn-warning">Compartir lista</a>
                    <a href="<?= base_url('Lists/form_edit_list/'.$i->id) ?>" class="btn btn-dark">Editar</a>
                    <a href="<?= base_url('Lists/delete_list/'.$i->id) ?>" class="btn">Eliminar</a>
                </li>
                <?php  } ?> 
            </ul>
        </main>
    </div>
</div>