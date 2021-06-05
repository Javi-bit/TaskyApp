<div class="container-fluid list-subtask">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <h2 class="title">
                Nombre de la tarea
                <!-- <?= $task_name ?> -->
            </h2>
            <table class="table">
                <thead>
                    <tr class="table-light">
                        <th scope="col">
                            <a href="<?= base_url('Subtask/list_subtasks/'.$_SESSION['task_id'].'/name') ?>">Asunto</a>    
                        </th>
                        <th scope="col">
                            <a>Descripción</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('Subtask/list_subtasks/'.$_SESSION['task_id'].'/name') ?>">Estado</a>    
                        </th>
                        <th scope="col">
                            <a>Acciones</a>    
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach ($list_subtasks as $item) { 
                        $subtask = subtask_data(clone $item);
                    ?>        
                        <tr>
                            <td><?= $subtask->name ?></td>
                            <td><a href="<?= base_url().'Subtask/show_subtask/'.$subtask->id ?>" class="btn btn-sm btn-success">Ver</a></td>
                            <td class="<?= subtask_state($item) ?>">Incompleta</td>
                            <td>
                                <a href="<?= base_url().'Subtask/form_edit_subtask/'.$subtask->id ?>" class="btn btn-sm btn-dark">Editar</a>
                                <a href="<?= base_url().'Subtask/delete_subtask/'.$subtask->id ?>" class="btn btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
</div>