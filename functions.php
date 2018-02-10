<?php

function task_count($task_array, $project_name, $show_complete_tasks)
{
    $count=0;
    
    foreach ($task_array as $task) {
        if ($show_complete_tasks == 1 || $task ['is_done'] == false) {
            if ($task ['project'] == $project_name || $project_name == 'Все') {
                $count++;
            }
        }
    }

    return $count; 
}

function render_template($template_path, $template_vars)
{
    if (file_exists ($template_path)) {
        ob_start();
        extract($template_vars);
        require_once($template_path);
        $result = ob_get_clean ();
    } else {
        $result = null;
    }

    return $result;
}

function time_remains($date)
{
    if (!empty($date)) {
        $result = floor((strtotime($date) - strtotime(today)) / 86400);
    } else {
        $result = null;
    }

    return $result;
}
?>
