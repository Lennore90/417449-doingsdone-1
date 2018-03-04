<?php

session_start();
date_default_timezone_set('Europe/Moscow');

// показывать или нет выполненные задачи
$show_complete_tasks = $_COOKIE['show_completed'] ?? 0;

if (isset($_GET['show_completed'])) { 
    $show_complete_tasks = !$show_complete_tasks; 
    setcookie('show_completed', $show_complete_tasks, strtotime("+7 days"), '/'); 
} 

require_once('init.php');
require_once('data.php');

$add_form = '';
$errors = [];
$error_class = 'form__input--error';
$error_message = '<p class="form__message">Заполните это поле</p>';
$required_fields = [
    'task_add' => ['name','project'],
    'project_add' => ['name'],
    'login' => ['email', 'password'],
    'sign_up' => ['email', 'password','name']
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

            $user = search_user($db, $_POST['email']);

            if (empty($user)) {
                $errors['login'][] = 'email';
            }

            if (!empty($user) && password_verify($_POST['password'],$user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: /index.php" );
            } else {
                $errors['login'][] = 'password';
            }
        }
        if ($form == 'sign_up') {
            if (empty(search_user($db, $_POST['email']))) {
      
                $safe_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $safe_name = $_POST['name'];
                $safe_email = $_POST['email'];

                $sql = "INSERT INTO users (`name`, `email`, `password`, `contact_info`, `reg_date`) VALUES (?, ?, ?, ?, ?)";

                $data = [
                    $safe_name,
                    $safe_email,
                    $safe_pass,
                    $safe_email,
                    date('Y-m-d')
                ];

                $stmt = db_get_prepare_stmt($db, $sql, $data);

                mysqli_stmt_execute($stmt);

                header("Location: /index.php" );
            } else {
                $errors['sign_up'][] = 'email';
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
            'error_class' => $error_class,
            'error_message' => $error_message,
        ]
    );
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

    var_dump($sql = "SELECT projects.id, projects.name FROM projects JOIN users ON projects.user_id=users.id WHERE users.name = '".$_SESSION['user']['name']." ' ");
    $project_list = mysqli_query($db, $sql);
    
    $sql = "SELECT * FROM tasks JOIN users ON tasks.user_id=users.id WHERE users.name = '".$_SESSION['user']['name']." ' ORDER BY assign_date";
    $task_list = mysqli_query($db, $sql);

    while ($row = mysqli_fetch_array($task_list)) {
        $task_id = $row['id'];
        $tasks[$task_id] = [
            'title' => $row['title'],
            'deadline' => $row['deadline'],
            'project' => $row['project_id'],
            'is_done' => false,
        ];
        if (!empty($row['completed'])) {
            $task['is_done'] = true;
        }
        if (!empty($row['file_link'])) {
            $task['task__file'] = $row['file_link'];
        }
    }

    $tasks_to_show = $tasks;

    if (!empty($_GET['project_id'])) {
        if (array_key_exists($_GET['project_id'], $project_list)) {
            $tasks_to_show = tasks_by_project($tasks, $project_list[$_GET['project_id']]);
        } else {
            http_response_code(404);
        }
    }
} elseif (isset($_GET['sign_up']) || !empty($errors['sign_up'])) {
    $content = render_template(
        'templates/register.php',
        [
            'errors' => $errors,
            'error_class' => $error_class,
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