<?php

$user_name = 'Константин';
$project_list = ["Все", "Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];

$tasks = [
    [
        'title' => "Собеседование в IT компании",
        'deadline' => "01.06.2018",
        'project' => "Работа",
        'is_done' => false,
        'task_file' => 'Резюме.doc',
    ],
    [
        'title' => "Выполнить тестовое задание",
        'deadline' => "25.05.2018",
        'project' => "Работа",
        'is_done' => false,
    ],
    [
        'title' => "Сделать задание первого раздела",
        'deadline' => "21.01.2018",
        'project' => "Учеба",
        'is_done' => true,
    ],
    [
        'title' => "Встреча с другом",
        'deadline' => "22.01.2018",
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
?>