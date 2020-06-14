<?php include __DIR__ . '/components/head.view.php' ?>

<main class="index" data-access="<?=$this->adminToken?>">

    <div class="index_controls">
        <a href="/add" class="index_controls-item" title="Создать новую задачу">
            <svg>
                <use xlink:href="#svgAdd"></use>
            </svg>
        </a>
        <?php if ($this->adminToken) { ?>
            <div id="index_controls-logout" class="index_controls-item" title="Выйти из системы">
                <svg>
                    <use xlink:href="#svgLogout"></use>
                </svg>
            </div>
            <div>Admin</div>
        <?php } else { ?>
            <a href="/auth" class="index_controls-item" title="Войти в систему">
                <svg>
                    <use xlink:href="#svgLogin"></use>
                </svg>
            </a>
        <?php } ?>
    </div>

    <div class="index_content">

        <div class="index_row mod_title">
            <?php foreach ($taskModel->fieldsList as $field => $header) { ?>
                <div class="index_row-item mod_<?= $field ?>"><?= $header ?>
                <?php if ($field !== 'content') { ?>
                    <div class="sortable mod_desc mod_<?= $field ?>" data-field="<?= $field ?>"
                    title="Сортировать по убыванию">
                        <svg class="sortable_item">
                            <use xlink:href="#sortUp"></use>
                        </svg>
                    </div>
                    <div class="sortable mod_asc mod_<?= $field ?>" data-field="<?= $field ?>"
                         title="Сортировать по возрастанию">
                        <svg class="sortable_item">
                            <use xlink:href="#sortDown"></use>
                        </svg>
                    </div>
                <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php
        if (count($currentPageTasks)) {
            foreach ($currentPageTasks as $task) { ?>
                <div class="index_row mod_tasks">
                    <?php foreach ($taskModel->fieldsList as $field => $header) { ?>
                        <div class="index_row-item mod_<?= $field ?>">
                            <?php if ($field !== 'is_done') {
                                echo $task[$field];
                            } else {
                                 if ($this->adminToken) {
                                     include __DIR__ . '/components/status_admin.view.php';
                                 } else {
                                     include __DIR__ . '/components/status_all.view.php';
                                 }
                            } ?>
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
