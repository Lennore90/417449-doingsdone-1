
<section class="content__side">
  <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>

  <a class="button button--transparent content__side-button" href="/?login">Войти</a>
</section>

<main class="content__main">
  <h2 class="content__main-heading">Регистрация аккаунта</h2>

  <form class="form" action="index.php" method="post">
    <div class="form__row">
      <label class="form__label" for="email">E-mail <sup>*</sup></label>

      <input class="form__input <?=!empty($_POST) && in_array('email', $errors['sign_up']) ? $error_class : '' ?>" type="text" name="email" id="email" value="" placeholder="Введите e-mail">
      <?=!empty($_POST) && in_array('email', $errors['sign_up']) ? '<p class="form__message">Введите корректный e-mail</p>' : '' ?>
    </div>

    <div class="form__row">
      <label class="form__label" for="password">Пароль <sup>*</sup></label>

      <input class="form__input <?=!empty($_POST) && in_array('password', $errors['sign_up']) ? $error_class : '' ?>" type="password" name="password" id="password" value="" placeholder="Введите пароль">
      <?=!empty($_POST) && in_array('password', $errors['sign_up']) ? '<p class="form__message">Введите пароль</p>' : '' ?>
    </div>

    <div class="form__row">
      <label class="form__label" for="name">Имя <sup>*</sup></label>

      <input class="form__input <?=!empty($_POST) && in_array('name', $errors['sign_up']) ? $error_class : '' ?>" type="text" name="name" id="name" value="" placeholder="Введите Ваше имя">
      <?=!empty($_POST) && in_array('name', $errors['sign_up']) ? '<p class="form__message">Как к Вам обращаться?</p>' : '' ?>
    </div>

    <input type='hidden' name='action' value='sign_up'>

    <div class="form__row form__row--controls">
      <?=!empty($errors['sign_up']) ? '<p class="error-message">Пожалуйста, исправьте ошибки в форме</p>' : '' ?>

      <input class="button" type="submit" name="" value="Зарегистрироваться">
    </div>
  </form>
</main>