<div class="container-fluid new-list">
    <div class="row">
        <main class="col">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2 class="title">Crear cuenta</h2>
                    <form action="create" method="post">
                        <div class="form-group">
                            <label for="username">Nombre de Usuario</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="pass">Contraseña</label>
                            <input type="password" name="pass" id="pass" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-warning btn-submit">Registrarse</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>