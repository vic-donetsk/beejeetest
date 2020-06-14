<?php include __DIR__ . '/components/head.view.php' ?>

<main class="creation">
    <form class="creation_form" action="/save" method="post">
        <div class="creation_form-label"> Имя пользователя</div>
        <div id="creation_user" class="creation_form-item">
            <input type="text" name="user"
                   value="<?php if (isset($editedTask)) echo $editedTask['user'] ?>"
            >
        </div>
        <div class="is-error"></div>
        <div class="creation_form-label"> Электронная почта</div>
        <div id="creation_email" class="creation_form-item">
            <input type="text" name="email"
                   value="<?php if (isset($editedTask)) echo $editedTask['email'] ?>"
            >
        </div>
        <div class="is-error"></div>
        <div class="creation_form-label"> Описание задачи</div>
        <div id="creation_content" class="creation_form-item">
            <textarea name="content"><?php if (isset($editedTask)) echo $editedTask['content'] ?></textarea>
        </div>
        <div class="is-error"></div>

        <button type="submit" class="creation_form-submit">Сохранить</button>

    </form>

    <div class="creation_success-wrapper">
        <div class="creation_success">
            <div class="creation_success-info">
                <?php if (isset($editedTask)) ?>
                Новая задача успешно добавлена!
                <?php else ?>
                Изменения успешно сохранены
            </div>
            <a href="" class="creation_success-link">Вернуться к списку задач</a>
        </div>
    </div>

</main>

<?php include __DIR__ . '/components/footer.view.php' ?>
