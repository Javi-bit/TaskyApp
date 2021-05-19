<div class="container-fluid list-subtask">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <h2 class="list-name">
                Nombre de la tarea
                <!-- <?= $task_name ?> -->
            </h2>
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
                            <a href="<?= base_url('') ?>">Estado</a>    
                        </th>
                        <th scope="col">
                            <a href="<?= base_url('') ?>">Acciones</a>    
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>                      
                            <a href=""></a>Column content
                        </td>
                        <td><a href="">Ver</a></td>
                        <td class="incomplete">Incompleta</td>
                        <td>
                            <a href="">Editar</a>
                            <a href="">Eliminar</a>
                        </td>
                    </tr>
                <!-- <?php  foreach ($list_subtask as $item) { ?> -->
                <!-- <?php } ?> -->
                </tbody>
            </table>
        </main>
    </div>
</div>