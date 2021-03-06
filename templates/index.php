<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.html" method="post">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
        <a href="/" class="tasks-switch__item">Повестка дня</a>
        <a href="/" class="tasks-switch__item">Завтра</a>
        <a href="/" class="tasks-switch__item">Просроченные</a>
    </nav>

    <label class="checkbox">
        <a href="/?show_completed">
            <input class="checkbox__input visually-hidden" type="checkbox" <?=$show_complete_tasks == 1 ? 'checked' : ''?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </a>
    </label>
</div>

<table class="tasks">
    <? foreach ($tasks as $task):?>
        <? if ($show_complete_tasks == 1 || $task['is_done'] == false):?>
            <tr class="tasks__item task <?=$task['is_done'] === true ? 'task--completed' : ''?> <?=(!empty($task['deadline']) && $task['is_done'] == false && time_remains($task['deadline']) <= 1 ) ? 'task--important' :''?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden" type="checkbox" <?=$task['is_done'] === true ? 'checked' : ''?>>
                        <span class="checkbox__text"><?=($task['title'])?></span>
                    </label>
                </td>
                <td class="task__file">
                    <? if (!empty($task['task_file'])): ?>
                        <a class="download-link" href="#"><?=$task['task_file']?></a>
                    <? endif; ?>
                </td>
                <td class="task__date"><?=$task['deadline']?></td>
                <td class="task__controls">
                </td>
            </tr>
        <? endif; ?>      
    <? endforeach; ?>
</table>