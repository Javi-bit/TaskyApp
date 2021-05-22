<div class="container-fluid new-task">
    <div class="row">
        <?= $aside ?>

        <main class="col-10">
            <div class="row justify-content-center">
                <div class="col-8">
                    <h2 class="title">Nueva subtarea</h2>
                    <form action="create" method="post">
                        <div class="form-group">
                            <label for="name">Asunto</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="descrip">Descripción</label>
                            <textarea name="descrip" id="descrip" class="form-control" rows="8" required></textarea>
                        </div>
    
                        <div class="form-group">
                            <label for="state">Seleccionar estado de la tarea</label>
                            <select name="state" id="state" class="form-control" required>
                                <option value="0">Incompleto</option>
                                <option value="1">Completo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning btn-submit">Crear</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>