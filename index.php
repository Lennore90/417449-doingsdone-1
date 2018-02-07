<?php

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$project_list = ["Все", "Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];

$tasks = [
    [
        'title' => "Собеседование в IT компании",
        'deadline' => "01.06.2018",
        'project' => "Работа",
        'is_done' => false,
    ],
    [
        'title' => "Выполнить тестовое задание",
        'deadline' => "25.05.2018",
        'project' => "Работа",
        'is_done' => false,
    ],
    [
        'title' => "Сделать задание первого раздела",
        'deadline' => "21.04.2018",
        'project' => "Учеба",
        'is_done' => true,
    ],
    [
        'title' => "Встреча с другом",
        'deadline' => "22.04.2018",
        'project' => "Входящие",
        'is_done' => false,
    ],
    [
        'title' => "Купить корм для кота",
        'deadline' => null,
        'project' => "Домашние дела",
        'is_done' => false,
    ],
    [
        'title' => "Заказать пиццу",
        'deadline' => null,
        'project' => "Домашние дела",
        'is_done' => false,
    ],
];

$userName='Константин';

require_once('functions.php');

$content=renderTemplate('templates/index.php',['tasks'=>$tasks,
                                                    'show_complete_tasks'=>$show_complete_tasks,]);
$page_title='Дела в порядке';
$layout=renderTemplate('templates/layout.php', ['page_title'=>'Дела в порядке',
                                        'page_content'=>$content,
                                        'show_complete_tasks'=>$show_complete_tasks,
                                        'project_list'=>$project_list,
                                        'tasks'=>$tasks,
                                        'userName'=>$userName,
                                        ]);
print($layout);
?>