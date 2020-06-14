<div class="status">
    <input type="checkbox" class="status_admin" id="done_<?=$task['id']?>" value="<?=$task['id']?>"
        <?php if ($task['is_done']) { ?> checked disabled <?php } ?>
    >
    <label for="done_<?=$task['id']?>"> Выполнено </label>
</div>

<button class="status mod_edit-admin" data-id="<?=$task['id']?>">
    Редактировать
</button>
