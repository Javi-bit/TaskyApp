<div class="container-fluid list-tasks">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <h2 class="title">
                <?= $list_name ?>
            </h2>
            <p><b>Descripción:</b> <?= $list_descrip ? $list_descrip : 'sin descripción' ?></p>
            <table class="table">
                <thead>
                    <tr class="table-light">
                        <th scope="col">
                            <a href="<?= base_url('Task/list_tasks/'.$_SESSION['list_id'].'/name') ?>">Asunto</a>    
                        </th>
                        <th scope="col">
                            <a>Descripción</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('Task/list_tasks/'.$_SESSION['list_id'].'/expir') ?>">Vencimiento</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('Task/list_tasks/'.$_SESSION['list_id'].'/memo') ?>">Recordatorio</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('Task/list_tasks/'.$_SESSION['list_id'].'/state') ?>">Estado</a>    
                        </th>
                        <th scope="col">
                            <a>Subtareas</a>    
                        </th>
                        <th scope="col">
                            <a>Acciones</a>    
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php  
                    if(!empty($list_tasks)){
                        foreach ($list_tasks as $item) { 
                            $task = task_data(clone $item);
                ?>
                    <tr class="<?= task_colour($item) ?>">
                        <td>                      
                            <a class="priori <?= task_priori($item) ?>" href="<?= base_url('Task/list_tasks/'.$_SESSION['list_id'].'/priori') ?>"><i class='bx bxs-square'></i></a><?= $task->name?>
                        </td>
                        <td><a href="<?= base_url('Task/show_task/'.$task->id) ?>" class="btn btn-sm btn-info">Ver</a></td>
                        <td><?= $task->expir?></td>
                        <td><?= $task->memo?></td>
                        <td class="<?= task_state($item) ?>"><?= $task->state?></td>
                        <td><a href="<?= base_url('Subtask/list_subtasks/'.$task->id) ?>" class="btn btn-sm btn-info">Ver</a></td>
                        <td>
                            <a href="<?= base_url('Task/form_edit_task/'.$task->id) ?>" class="btn btn-sm btn-dark">Editar</a>
                            <a href="<?= base_url('Task/delete_task/'.$task->id) ?>" class="btn btn-sm" >Eliminar</a>
                        </td>
                    </tr>
                <?php   } 
                      } ?>
                </tbody>
            </table>


        </main>
    </div>
</div>