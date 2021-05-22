<?php 

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
                'label' => 'password',
                'rules' => 'required|min_length[8]',
                'errors' => array(
                        'required' => 'El %s es requerido.',
                        'min_length' => 'El %s requiere al menos 8 caracteres.'
                )
            ),
        );
    }

?>