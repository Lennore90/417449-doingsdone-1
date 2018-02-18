<? if (isset($_GET['task_add']) || !empty($errors['task_add'])): ?>
  <div class="modal">
    <a href="/index.php"><button class="modal__close" type="button" name="button">Закрыть</button></a>

    <h2 class="modal__heading">Добавление задачи</h2>

    <form class="form"  action="index.php" method="post">
      <div class="form__row">
        <label class="form__label" for="name">Название <sup>*</sup></label>

        <input class="form__input <?=!empty($errors) && in_array('name', $errors['task_add']) ? $error_class : '' ?>" type="text" name="name" id="name" value="" placeholder="Введите название">
        <?=!empty($errors) && in_array('name', $errors['task_add']) ? $error_message : ''?>
      </div>

      <div class="form__row">
        <label class="form__label" for="project">Проект <sup>*</sup></label>

        <select class="form__input form__input--select <?=!empty($errors) && in_array('project', $errors['task_add']) ? $error_class : '' ?>" name="project" id="project">
          <option value="">--Выберите проект--</option>
          <? foreach ($project_list as $category):?>
            <option value="<?=$category?>"><?=$category?></option>
          <? endforeach; ?>
        </select>
        <?=!empty($errors) && in_array('project', $errors['task_add']) ? $error_message : ''?>
      </div>

      <div class="form__row">
        <label class="form__label" for="date">Дата выполнения</label>

        <input class="form__input form__input--date" type="date" name="date" id="date" value="" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
      </div>

      <div class="form__row">
        <label class="form__label" for="preview">Файл</label>

        <div class="form__input-file">
          <input type="hidden" name="MAX_FILE_SIZE" value="30000">
          <input class="visually-hidden" type="file" name="task_file" enctype="multipart/form-data" id="task_file" value="">

          <label class="button button--transparent" for="task_file">
              <span>Выберите файл</span>
          </label>
        </div>
      </div>

      <input type='hidden' name='action' value='task_add'>

      <div class="form__row form__row--controls">
        <input class="button" type="submit" name="" value="Добавить">
      </div>
    </form>
  </div>

<? elseif (isset($_GET['project_add'])|| !empty($errors['project_add'])): ?>
  <div class="modal">
    <a href="/index.php"><button class="modal__close" type="button" name="button">Закрыть</button></a>

    <h2 class="modal__heading">Добавление проекта</h2>

    <form class="form"  action="index.php" method="post">
      <div class="form__row">
        <label class="form__label" for="project_name">Название <sup>*</sup></label>

        <input class="form__input <?=!empty($errors) && in_array('name', $errors['project_add']) ? $error_class : '' ?>" type="text" name="name" id="project_name" value="" placeholder="Введите название проекта">
        <<?=!empty($errors) && in_array('name', $errors['project_add']) ? $error_message : ''?>
      </div>
      <input type='hidden' name='action' value='project_add'>

      <div class="form__row form__row--controls">
        <input class="button" type="submit" name="" value="Добавить">
      </div>
    </form>
  </div>
<? endif; ?>