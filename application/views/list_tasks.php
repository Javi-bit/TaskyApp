<div class="container-fluid list-tasks">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <h2 class="title">
                Nombre de la lista
                <!-- <?= $list_name ?> -->
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
                    <tr class="colour-3">
                        <td>                      
                            <a class="priori priori-1" href=""><i class='bx bxs-square'></i></a>Column content
                        </td>
                        <td><a href="">Ver</a></td>
                        <td>20-10-2021</td>
                        <td>18-10-2021</td>
                        <td class="incomplete">Incompleta</td>
                        <td><a href="">Ver</a></td>
                        <td>
                            <a href="">Editar</a>
                            <a href="">Eliminar</a>
                        </td>
                    </tr>
                <!-- <?php  foreach ($list_tasks as $item) { ?> -->
                <!-- <?php } ?> -->
                </tbody>
            </table>


        </main>
    </div>
</div>