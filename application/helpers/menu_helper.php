<?php 

    function main_menu() {

        $menu = array(
            array(
                'name' => 'Tasky',
                'url' => base_url('Lists')
            )
        );
        
        if(isset($_SESSION['user_id'])) {
            array_push($menu, array(
                'name' => 'Cerrar sesión',
                'url' => base_url('User/log_out')
            ),
            array(
                'name' => 'Editar cuenta',
                'url' => base_url('User/form_edit')
            ));

        } else {
            array_push($menu, array(
                'name' => 'Iniciar sesión',
                'url' => base_url('User/form_log_in')
            ),
            array(
                'name' => 'Crear cuenta',
                'url' => base_url('User/form_sing_up')
            ));
        }
        
        return $menu;
    }
        
    function lists_menu () {
        
        $menu = array(
            array(
                'name' => 'Nueva lista',
                'url' => base_url('Lists/form_new_list'),
            )
        );

        if(current_url() !== base_url('Lists')) {
            array_push($menu, array(
                'name' => '<i class="bx bx-arrow-back"></i> Volver',
                'url' => base_url('Lists'),
            ));
        }
        
        return $menu;
    }

    function list_tasks_menu($id) {
        
        $menu = array(
            array(
                'name' => 'Nueva tarea',
                'url' => base_url('Task/form_new_task/'.$id),
            ),
            array(
                'name' => 'Ordenar tareas',
                'url' => base_url(''),
            ),
            array(
                'name' => 'Ver listas',
                'url' => base_url('Lists'),
            )
        );

        if(!strpos(current_url(), 'list_tasks')) {
            if(current_url() !== base_url('Lists')) {
                array_push($menu, array(
                    'name' => '<i class="bx bx-arrow-back"></i> Volver',
                    'url' => base_url('Task/list_tasks/'.$id),
                ));
            }
        }
        
        return $menu;
    }
    
    function list_subtasks_menu($id_task, $id_list) {
        $menu = array(
            array(
                'name' => 'Nueva subtarea',
                'url' => base_url('Subtask/form_new'),
            ),
            array(
                'name' => 'Ordenar subtareas',
                'url' => base_url(''),
            ),
            array(
                'name' => 'Ver listas',
                'url' => base_url('Lists'),
            ),
            array(
                'name' => 'Ver tareas',
                'url' => base_url('Task/list_tasks/'.$id_list),
            )
        );

        if(!strpos(current_url(), 'list_subtasks')) {
            if(current_url() !== base_url('Lists')) {
                array_push($menu, array(
                    'name' => '<i class="bx bx-arrow-back"></i> Volver',
                    'url' => base_url('Subtask/list_subtasks/'.$id_task),
                ));
            }
        }
        
        return $menu;
    }

?>