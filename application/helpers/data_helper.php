<?php 

    function task_data($task) 
    {
        $task->expir = $task->expir === '0000-00-00' ? 'Sin fecha' : $task->expir; 
        $task->memo = $task->memo === '0000-00-00' ? 'Sin fecha' : $task->memo;
        $task->state = $task->state === '1' ? 'Completa' : 'Incompleta';

        switch ($task->priori) {
            case '1':
                $task->priori = 'Baja';
                break;
            
            case '2':
                $task->priori = 'Media';
                break;
            
            case '3':
                $task->priori = 'Alta';
                break;
        }

        return $task;
    }

    function task_state($task) {
        return $task->state === '1' ? 'complete' : 'incomplete';
    }

    function task_priori($task) {
        switch ($task->priori) {
            case '1':
                return 'priori-1';
                break;
            
            case '2':
                return 'priori-2';
                break;
            
            case '3':
                return 'priori-3';
                break;
        }
    }
    
    function task_colour($task) {
        switch ($task->colour) {
            case '#ffffff':
                return 'colour-0';
                break;
            
            case '#dae8fc':
                return 'colour-1';
                break;
            
            case '#d5e8d4':
                return 'colour-2';
                break;

            case '#ffe6cc':
                return 'colour-3';
                break;

            case '#fff2cc':
                return 'colour-4';
                break;

            case '#f8cecc':
                return 'colour-5';
                break;

            case '#e1d5e7':
                return 'colour-6';
                break;

            case '#e2e2e2':
                return 'colour-7';
                break;
        }
    }

?>
