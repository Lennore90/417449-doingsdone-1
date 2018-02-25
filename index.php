<?php

session_start();
date_default_timezone_set('Europe/Moscow');

// показывать или нет выполненные задачи
$show_complete_tasks = $_COOKIE['show_completed'] ?? 0;

if (isset($_GET['show_completed'])) { 
    $show_complete_tasks = !$show_complete_tasks; 
    setcookie('show_completed', $show_complete_tasks, strtotime("+7 days"), '/'); 
} 

require_once('functions.php');
require_once('data.php');
require_once('userdata.php');

$add_form = '';
$errors = [];
$error_class = 'form__input--error';
$error_message = '<p class="form__message">Заполните это поле</p>';
$required_fields = [
    'task_add' => ['name','project'],
    'project_add' => ['name'],
    'login' => ['email', 'password'],
];

if (!empty($_POST)) {
    $form = $_POST['action'];
    $errors[$form] = [];
    foreach ($required_fields[$form] as  $field) {
        if (!array_key_exists($field,$_POST) || empty($_POST[$field])) {
            $errors[$form][] = $field;
        } else {
            if ($field == 'project' && !in_array($_POST['project'], $project_list)) {
                $errors[$form][] = $field;
            }
            if ($field == 'email' && !filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
                $errors[$form][] = $field;
            } 
        }
    }

    if (empty($errors[$form])) {
        $errors = [];
        if ($form == 'login') {
            $user = search_user($_POST['email'],$users);
            if (!in_array($_POST['email'],$user)) {
                $errors['login'][] = 'email';
            }

            if (!empty($user) && password_verify($_POST['password'],$user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: /index.php" );
            } else {
                $errors['login'][] = 'password';
            }
        }

        if ($form == 'project_add') {
            $project_list[] = htmlspecialchars($_POST['name']);
        }

        if ($form == 'task_add') {
            $new_task = 
                [
                'title' => htmlspecialchars($_POST['name']),
                'deadline' => date('d.m.Y',strtotime($_POST['date'])),
                'project' => htmlspecialchars($_POST['project']),
                'is_done' => false,
                ];
            if (!empty($_FILES) && is_uploaded_file($_FILES['task_file']['tmp_name'])) {
                move_uploaded_file($_FILES['task_file']['tmp_name'], $_FILES['task_file']['name']);
                $new_task['task_file'] = $_FILES['task_file']['name'];
            }
            
            array_unshift($tasks, $new_task);
        }
    }
}

if (isset($_GET['task_add']) || isset($_GET['project_add']) || isset($_GET['login']) || !empty($errors)) {
    $add_form = render_template(
        'templates/forms.php',
        [
            'errors' => $errors,
            'project_list' => $project_list,
            'error_class' => $error_class,
            'error_message' => $error_message,
            'users' => $users,
            'user' => $user ?? '',
        ]
    );
}


$tasks_to_show = $tasks;

if (!empty($_GET['project_id'])) {
    if (array_key_exists($_GET['project_id'], $project_list)) {
        $tasks_to_show = tasks_by_project($tasks, $project_list[$_GET['project_id']]);
    } else {
        http_response_code(404);
    }
}



if (!empty($_SESSION['user'])) {
    $content = render_template(
        'templates/index.php',
        [
            'project_list' => $project_list,
            'tasks' => $tasks_to_show ?? [],
            'show_complete_tasks' => $show_complete_tasks,
        ]
    );
} else {
    $content = render_template('templates/guest.php', []);
}

$page_layout = render_template(
    'templates/layout.php',
    [
        'page_title' => 'Дела в порядке',
        'page_content' => $content,
        'show_complete_tasks' => $show_complete_tasks,
        'project_list' => $project_list ?? [],
        'tasks' => $tasks,
        'user_name' => $_SESSION['user'] ?? '',
        'add_form' => $add_form,
        'errors' => $errors,
    ]
);

print($page_layout);

?>