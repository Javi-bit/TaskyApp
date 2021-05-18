<?php 

    function main_menu() {
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

    function list_tasks_menu() {
        return array(
            array(
                'name' => 'Nueva tarea',
                'url' => base_url(''),
            ),
            array(
                'name' => 'Ordenar lista',
                'url' => base_url(''),
            )
        );    
    }

?>