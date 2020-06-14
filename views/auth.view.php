<?php include __DIR__ . '/components/head.view.php' ?>

<main class="auth">
    <form class="auth_form" action="/login" method="get">
        <div class="auth_form-label"> Имя пользователя</div>
        <div id="auth_login" class="auth_form-item">
            <input type="text" name="login">
        </div>
        <div class="is-error"></div>
        <div class="auth_form-label"> Пароль</div>
        <div id="auth_password" class="auth_form-item">
            <input type="password" name="password">
        </div>
        <div class="is-error"></div>

        <button type="submit" class="auth_form-submit">Войти</button>

    </form>
</main>

<?php include __DIR__ . '/components/footer.view.php' ?>
