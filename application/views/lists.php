<div class="container-fluid list-tasks">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <h2 class="title">
                Listas
            </h2>
            <ul class="lists">
                <!-- <?php  foreach ($lists as $item) { ?> -->
                <!-- <?php } ?> -->
                <li class="list-item">
                    <a href="<?= base_url('Task/list_tasks/id') ?>" class="btn">Lista 1</a>
                    <a href="<?= base_url('Lists/share_list/id') ?>" class="btn btn-warning">Compartir lista</a>
                    <a href="<?= base_url('Lists/delete_list/id') ?>" class="btn">Eliminar</a>
                </li>
                <li class="list-item">
                    <a href="" class="btn">Lista 2</a>
                    <a href="" class="btn btn-warning">Compartir lista</a>
                    <a href="" class="btn">Eliminar</a>
                </li>
                <li class="list-item">
                    <a href="" class="btn">Lista 3</a>
                    <a href="" class="btn btn-warning">Compartir lista</a>
                    <a href="" class="btn">Eliminar</a>
                </li>
            </ul>
        </main>
    </div>
</div>