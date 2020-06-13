<?php include __DIR__ . '/components/head.view.php' ?>

<main class="index">

    <div class="index_content">

    <div class="index_row mod_title">
        <?php foreach ($model->fieldsList as $field => $header) { ?>
            <div class="index_row-item mod_<?= $field ?>"><?= $header ?></div>
        <?php } ?>
    </div>
    <?php
    if (count($currentPageTasks)) {
        foreach ($currentPageTasks as $task) { ?>
            <div class="index_row mod_tasks">
                <?php foreach ($model->fieldsList as $field => $header) { ?>
                    <div class="index_row-item mod_<?= $field ?>">
                    <?php if ($field !== 'is_done') {
                        echo $task[$field];
                    } else { ?>
                        <?php if ($task['is_done']) { ?>
                            <button class="status mod_done" disabled>
                                Выполнено
                            </button>
                        <?php } else { ?>
                            <button class="status mod_expected">
                                Ожидает выполнения
                            </button>
                        <?php } ?>
                        <?php if ($task['is_edited']) { ?>
                            <button class="status mod_edited" disabled>
                                Отредактировано админом
                            </button>
                        <?php } ?>
                    <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
    } else { ?>
        <div class="index_empty"> Список заданий пуст </div>
    <?php } ?>
    </div>

    <?php if ($currentPagination) { ?>
        <div class="index_pagination">
            <?php foreach($currentPagination as $paginationItem) { ?>
                <div class="index_pagination-item
                            <?php if ($paginationItem == $currentPageNumber)  { echo 'mod_active'; }
                            else if ($paginationItem !== '..')  { echo 'mod_selectable'; } ?> ">
                    <?= $paginationItem ?>
                </div>
            <?php } ?>

        </div>
    <?php } ?>


</main>

<?php include __DIR__ . '/components/footer.view.php' ?>
