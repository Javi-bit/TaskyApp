<?php 

    function main_menu() {
        return array(
            array(
                'name' => 'Tasky',
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

    function lists_menu () {
        return array(
            array(
                'name' => 'Nueva lista',
                'url' => base_url('Lists/new'),
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
    
    function list_subtasks_menu() {
        return array(
            array(
                'name' => 'Nueva subtarea',
                'url' => base_url(''),
            ),
            array(
                'name' => 'Ordenar lista',
                'url' => base_url(''),
            )
        );    
    }

?>