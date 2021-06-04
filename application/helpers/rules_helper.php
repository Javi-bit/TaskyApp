<?php 
    // USER RULES 
    // ---------------------------------
    function rules_sign_up() {
        return array(
            array(
                'field' => 'username',
                'label' => 'nombre de usuario',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'El %s es requerido.'
                )
            ),
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => array(
                        'required' => 'El %s es requerido.',
                        'valid_email' => 'El %s ingresado no es correcto.',
                        'is_unique' => 'El %s ingresado ya ha sido ingresado.'
                )
            ),
            array(
                'field' => 'pass',
                'label' => 'contraseña',
                'rules' => 'required|min_length[8]',
                'errors' => array(
                        'required' => 'La %s es requerida.',
                        'min_length' => 'La %s requiere al menos 8 caracteres.'
                )
            )
        );
    }

    // LOG ING RULES 
    // ---------------------------------
    function rules_log_in() {
        return array(
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|valid_email',
                'errors' => array(
                        'required' => 'El %s es requerido.',
                        'valid_email' => 'El %s ingresado no es correcto.',
                )
            ),
            array(
                'field' => 'pass',
                'label' => 'contraseña',
                'rules' => 'required|min_length[8]',
                'errors' => array(
                        'required' => 'La %s es requerida.',
                        'min_length' => 'La %s requiere al menos 8 caracteres.'
                )
            )
        );
    }
    
    // LIST RULES 
    // ---------------------------------
    function rules_new_list() {
        return array(
            array(
                'field' => 'name',
                'label' => 'nombre de la subtarea',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'El %s es requerido.'
                )
            )    
        );
    }

    // TASK RULES 
    // ---------------------------------
    function rules_new_task() {
        return array(
            array(
                'field' => 'name',
                'label' => 'nombre de la tarea',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'El %s es requerido.'
                )
            ),    
            array(
                'field' => 'memo',
                'label' => 'fecha de recordatorio',
                'rules' => 'callback_check_memo',
                'errors' => array(
                        'check_memo' => 'La %s no puede ser igual o posterior al vencimiento.'
                )
            )    
        );
    }
    
    // SUBTASK RULES 
    // ---------------------------------
    function rules_new_subtask() {
        return array(
            array(
                'field' => 'name',
                'label' => 'nombre de la subtarea',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'El %s es requerido.'
                )
            )    
        );
    }

            
    // CHANGE PASS
    // ---------------------------------
    function rules_change_pass() {
        return array(
            array(
                'field' => 'old_pass',
                'label' => 'contraseña anterior',
                'rules' => 'callback_check_old_pass',
                'errors' => array(
                    'check_old_pass' => 'La %s no es válida.'
                )
            ),
            array(
                'field' => 'new_pass',
                'label' => 'contraseña nueva',
                'rules' => 'required|min_length[8]',
                'errors' => array(
                    'required' => 'La %s es requerida.',
                    'min_length' => 'La %s requiere al menos 8 caracteres.'                    
                )
            )
        );
    }

    // EDIT USER 
    // ---------------------------------
    function rules_edit_user() {
        return array(
            array(
                'field' => 'username',
                'label' => 'nombre de usuario',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'El %s es requerido.'
                )
            ),
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|valid_email',
                'errors' => array(
                        'required' => 'El %s es requerido.',
                        'valid_email' => 'El %s ingresado no es correcto.'
                )
            )
        );
    }
    
    // SHARE LIST RULES 
    // ---------------------------------
    function rules_share_list() {
        return array(
            array(
                'field' => 'email',
                'label' => 'e-mail',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'El %s es requerido.'
                )
            )    
        );
    }
    
?>