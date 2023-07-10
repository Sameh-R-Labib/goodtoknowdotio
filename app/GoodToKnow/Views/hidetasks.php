<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/hide_tasks_processor/page" method="post">
    <h1>Hide Tasks</h1>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">Hide the tasks you don't want to be presented with.</span>
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
