<?php

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

require_once('functions.php');
require_once('data.php');

$content = render_template(
    'templates/index.php',
    [
        'project_list' => $project_list,
        'tasks' => $tasks ?? [],
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

var_dump($_GET[id]);
?>