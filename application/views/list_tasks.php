<div class="container-fluid list-tasks">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <h2 class="title">
                <?= $list_name ?>
            </h2>
            <h4>Descripción: <?= $list_descrip?></h4>
            <table class="table">
                <thead>
                    <tr class="table-light">
                        <th scope="col">
                            <a href="<?= base_url('') ?>">Asunto</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('') ?>">Descripción</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('') ?>">Vencimiento</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('') ?>">Recordatorio</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('') ?>">Estado</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('') ?>">Subtareas</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('') ?>">Acciones</a>    
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php  foreach ($list_tasks as $item) { ?>
                    <tr class="colour-3">
                        <td>                      
                            <a class="priori priori-1" href=""><i class='bx bxs-square'></i></a><?= $item->name?>
                        </td>
                        <td><a href="<?= base_url().'Task/show/task_id' ?>">Ver</a></td>
                        <td><?= $item->expir?></td>
                        <td><?= $item->memmo?></td>
                        <td class="incomplete"><?= $item->state?></td>
                        <td><a href="<?= base_url().'Subtask/list_subtasks/'.$item->id ?>">Ver</a></td>
                        <td>
                            <a href="<?= base_url().'Task/form_edit/'.$item->id ?>">Editar</a>
                            <a href="<?= base_url().'Task/form_delete/'.$item->id ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


        </main>
    </div>
</div>