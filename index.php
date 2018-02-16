<?php

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

require_once('functions.php');
require_once('data.php');

$tasks_to_show = $tasks;

if (!empty($_GET['project_id'])) {
    if (array_key_exists($_GET['project_id'], $project_list)) {
        $tasks_to_show = tasks_by_project($tasks, $project_list[$_GET['project_id']]);
    } else {
        http_response_code(404);
    }
}

$content = render_template(
    'templates/index.php',
    [
        'project_list' => $project_list,
        'tasks' => $tasks_to_show ?? [],
        'show_complete_tasks' => $show_complete_tasks,
    ]
);

$page_layout = render_template(
    'templates/layout.php',
    [
        'page_title' => 'Дела в порядке',
        'page_content' => $content,
        'show_complete_tasks' => $show_complete_tasks,
        'project_list' => $project_list ?? [],
        'tasks' => $tasks,
        'user_name' => $user_name,
    ]
);

print($page_layout);

?>