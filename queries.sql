USE doingsdone;
# Добавление аккаунтов пользователей
INSERT INTO users SET email = 'ignat.v@gmail.com', contacts = 'ignat.v@gmail.com', name = 'Игнат', password = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', reg_date = '2017-02-20';
INSERT INTO users SET email = 'kitty_93@li.ru', contacts = 'kitty_93@li.ru', name = 'Леночка', password = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', reg_date = '2018-01-01';
INSERT INTO users SET email = 'warrior07@mail.ru', contacts = 'warrior07@mail.ru', name = 'Руслан', password = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', reg_date = '2017-12-11';

# Добавление проектов с привязкой к пользователям
INSERT INTO projects SET name = 'Входящие', user_id = 1;
INSERT INTO projects SET name = 'Входящие', user_id = 2;
INSERT INTO projects SET name = 'Входящие', user_id = 3;
INSERT INTO projects SET name = 'Учеба', user_id = 2;
INSERT INTO projects SET name = 'Работа', user_id = 1;
INSERT INTO projects SET name = 'Домашние дела', user_id = 2;
INSERT INTO projects SET name = 'Авто', user_id = 1;

# Добавление задач с привязкой к пользователям и их проектам
INSERT INTO tasks SET name = 'Сделать задание первого раздела', assign_date = '2018-01-18', deadline = '2018-01-21', completed = '2018-01-20', user_id = 2, project_id = 4;
INSERT INTO tasks SET name = 'Собеседование в IT компании', assign_date = '2018-02-15', deadline = '2018-06-01', file_link = '/Резюме.doc', user_id = 1, project_id = 5;
INSERT INTO tasks SET name = 'Выполнить тестовое задание', assign_date = '2018-02-15', deadline = '2018-05-25', user_id = 1, project_id = 5;
INSERT INTO tasks SET name = 'Встреча с другом', assign_date = '2018-02-23', deadline = '2018-01-28', user_id = 3, project_id = 3;
INSERT INTO tasks SET name = 'Купить корм для кота', assign_date = '2018-02-18', user_id = 2, project_id = 6;
INSERT INTO tasks SET name = 'Заказать пиццу', assign_date = '2018-02-21', user_id = 3, project_id = 3;

# Получить список проектов для одного пользователя
SELECT * FROM tasks WHERE user_id = 3;

# Получить список задач для одного проекта
SELECT * FROM tasks WHERE project_id = 5;

# Пометить задачу как выполненную
UPDATE tasks SET completed = today WHERE id = 5;

# Получить все задачи для завтрашнего дня
SELECT name, user_id FROM tasks WHERE deadline = tomorrow ORDER BY user_id;

# Обновить название задачи по ее идентификатору
UPDATE tasks SET name = 'Заказать суши' WHERE id = 6;