<?php include __DIR__ . '/components/head.view.php' ?>

<main class="creation">
    <form class="creation_form" action="/save" method="post">

        <div id="creation_user" class="creation_form-item">
            <input type="text" name="user">
        </div>
        <div class="is-error"></div>
        <div id="creation_email" class="creation_form-item">
            <input type="text" name="email">
        </div>
        <div class="is-error"></div>
        <div id="creation_content" class="creation_form-item">
            <textarea name="content"></textarea>
        </div>
        <div class="is-error"></div>

        <button type="submit" class="creation_form-submit">Сохранить</button>

    </form>
</main>

<?php include __DIR__ . '/components/footer.view.php' ?>
