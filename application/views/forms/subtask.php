<form action="#" method="post" class="container">
    <div class="row">
        <div class="form-group col-12">
            <label for="name">Asunto</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group col-12">
            <label for="descrip">Descripción</label>
            <textarea name="descrip" id="descrip" required></textarea>
        </div>

        <div class="form-group col-12">
            <label for="expir">Fecha de Vencimiento</label>
            <input type="date" name="expir" id="expir" class="form-control" required>
        </div>

        <div class="form-group col-12">
            <label for="memo">Fecha de Recordatorio</label>
            <input type="date" name="memo" id="memo" class="form-control">
        </div>

        <div class="form-group col-12">
            <div class="select-colour">
                <label>Seleccionar Color</label>
                <input class="color-input" data-huebee='{   "notation": "hex",
                                                            "saturations": 2,
                                                            "shades": 0,
                                                            "customColors": [   "#dae8fc", "#d5e8d4",
                                                                                "#ffe6cc", "#fff2cc",
                                                                                "#f8cecc", "#e1d5e7"] }' required/>
            </div>
        </div>
        <div class="form-group col-12">
            <div class="select-state">
                <label for="state">Seleccionar Estado de la Tarea</label>
                <select name="state" id="state" required>
                    <option value="0">Completo</option>
                    <option value="1">Incompleto</option>
                </select>
            </div>
        </div>
        <button type="submit">Crear</button>
    </div>
</form>

