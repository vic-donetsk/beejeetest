<?php if ($task['is_done']) { ?>
    <button class="status mod_done" disabled>
        Выполнено
    </button>
<?php //} else { ?>
<!--    <button class="status mod_expected">-->
<!--        Ожидает выполнения-->
<!--    </button>-->
<?php } ?>
<?php if ($task['is_edited']) { ?>
    <button class="status mod_edited" disabled>
        Отредактировано админом
    </button>
<?php } ?>
