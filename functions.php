<?php

function task_count($task_array, $project_id, $show_complete_tasks)
{
    $count=0;
    
    foreach ($task_array as $task) {
        if ($show_complete_tasks == 1 || empty($task['completed'])) {
            if ($task ['project'] == $project_id || $project_id === 0) {
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

function tasks_by_project($task_list, $project_id)
{
    $result = [];
    foreach ($task_list as $task) {
        if ($task['project'] == $project_id) {
            $result[] = $task;
        }

    }

    return $result;
}

function search_user($db, $email)
{
    $sql = "SELECT * FROM users WHERE email='".$email."'";
    $result = mysqli_query($db, $sql);
    
    $user =  $result->fetch_assoc();

    if (!$user) {
        $user = false;
    }

    return $user;
}

?>
