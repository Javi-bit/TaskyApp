<div class="container-fluid new-task">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-8">
                    <h2 class="title">Nueva tarea</h2>
                    <form action="create" method="post">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="<?= form_error('name') ? 'form-control error' : 'form-control' ?>">
                            <?= form_error('name', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="descrip">Descripción</label>
                            <textarea name="descrip" id="descrip" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="expir">Fecha de vencimiento</label>
                                <input type="date" name="expir" id="expir" class="form-control">
                            </div>
    
                            <div class="form-group col">
                                <label for="memo">Fecha de recordatorio</label>
                                <input type="date" name="memo" id="memo" class="form-control">
                            </div>
    
                            <div class="form-group col">
                                <label for="colour">Seleccionar color</label>
                                <input class="color-input form-control" name="colour" value="#ffffff" data-huebee='{   
                                                                        "notation": "hex",
                                                                        "saturations": 2,
                                                                        "shades": 0,
                                                                        "customColors": [   "#dae8fc", "#d5e8d4",
                                                                                            "#ffe6cc", "#fff2cc",
                                                                                            "#f8cecc", "#e1d5e7",
                                                                                            "#ffffff"] }'/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="priori">Seleccionar prioridad</label>
                                <select name="priori" id="priori" class="form-control">
                                    <option value="1">Baja</option>
                                    <option value="2">Media</option>
                                    <option value="3">Alta</option>
                                </select>
                            </div>
    
                            <div class="form-group col">
                                <label for="state">Seleccionar estado de la tarea</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="0">Incompleto</option>
                                    <option value="1">Completo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-submit">Crear</button>
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