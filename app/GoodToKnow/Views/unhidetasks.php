<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/un_hide_tasks_processor/page" method="post">
        <h1>Un-hide Tasks</h1>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">Un-hide the tasks you want to be presented with.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->array_of_objects as $key => $value): ?>
                <label class="checkbox">
                    <input type="checkbox" name="choice-<?= $key + 1 ?>" value="<?= $value->id ?>">
                    <?= $value->label ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>