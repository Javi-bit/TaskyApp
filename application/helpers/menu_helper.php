<?php 

    function mainMenu() {
        return array(
            array(
                'name' => 'Home',
                'url' => base_url('')
            ),
            array(
                'name' => 'Iniciar sesión',
                'url' => base_url('log_in')
            ),
            array(
                'name' => 'Crear cuenta',
                'url' => base_url('sign_in')
            ),
            array(
                'name' => 'Cerrar sesión',
                'url' => base_url('log_out')
            )
        );
    }

?>