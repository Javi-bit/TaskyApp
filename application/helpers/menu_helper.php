<?php 

    function main_menu() {
        return array(
            array(
                'name' => 'Tasky',
                'url' => base_url('')
            ),
            array(
                'name' => 'Iniciar sesión',
                'url' => base_url('User/log_in')
            ),
            array(
                'name' => 'Crear cuenta',
                'url' => base_url('User/sign_up')
            ),
            array(
                'name' => 'Cerrar sesión',
                'url' => base_url('User/log_out')
            )
        );
    }

    function lists_menu () {
        return array(
            array(
                'name' => 'Nueva lista',
                'url' => base_url('Lists/create'),
            )
        );    
    }

    function list_tasks_menu() {
        return array(
            array(
                'name' => 'Nueva tarea',
                'url' => base_url('Task/create'),
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
                'url' => base_url('Subtask/create'),
            ),
            array(
                'name' => 'Ordenar lista',
                'url' => base_url(''),
            )
        );    
    }

?>