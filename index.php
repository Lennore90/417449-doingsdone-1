<?php

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$tasks=[];
$project_list=[];
$userName=null;
$page_title='';

require_once('functions.php');
require_once('data.php');

$content=renderTemplate('templates/index.php', ['tasks'=>$tasks,
                                                'show_complete_tasks'=>$show_complete_tasks,
                                                'page_title'=>$page_title]);

$page_layout=renderTemplate('templates/layout.php', ['page_title'=>$page_title,
                                        'page_content'=>$content,
                                        'show_complete_tasks'=>$show_complete_tasks,
                                        'project_list'=>$project_list,
                                        'tasks'=>$tasks,
                                        'userName'=>$userName,
                                        ]);

print ($page_layout);

?>