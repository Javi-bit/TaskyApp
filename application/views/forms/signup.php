<form action="#" method="post" class="container">
    <div class="row">
        <div class="form-group col-12">
            <label for="username">Nombre de Usuario</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="form-group col-12">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" required>
            <small id="emailHelp" class="form-text text-muted">No compartiremos tu E-mail con nadie.</small>
        </div>


        <div class="form-group col-12">
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass" class="form-control" required>
        </div>

        <button type="submit" class="btn">Registrarse</button>
    </div>
</form>