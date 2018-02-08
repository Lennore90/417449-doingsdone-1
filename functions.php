<?php

function task_count($task_array, $project_name,$show_complete_tasks) {
    $count=0;
    
    foreach ($task_array as $task){
        if ($show_complete_tasks == 1 || $task['is_done'] == false){
            if ($task['project'] == $project_name || $project_name == 'Все'){
                $count++;
            }
        }
    }

    return $count; 
}

function renderTemplate($templatePath,$templateVars){
    if (file_exists($templatePath)){
        ob_start();
        extract($templateVars);
        require_once($templatePath);
        $result=ob_get_clean();
    }else{
        $result=null;
    }

    return $result;
}
?>
