<?php include __DIR__ . '/components/head.view.php' ?>

<main class="creation">
    <form class="creation_form" action="/save" method="post">

        <div class="creation_form-item">
            <input type="text" name="user">
            <div class="is-error"></div>
        </div>
        <div class="creation_form-item">
            <input type="text" name="email" class="creation_form-input">
            <div class="is-error"></div>
        </div>
        <div class="creation_form-item">
            <textarea name="content"></textarea>
            <div class="is-error"></div>
        </div>

        <button type="submit" class="creation_form-submit">Сохранить</button>

    </form>
</main>

<?php include __DIR__ . '/components/footer.view.php' ?>
