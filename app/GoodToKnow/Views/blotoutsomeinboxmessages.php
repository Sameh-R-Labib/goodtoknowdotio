<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/blot_out_some_inbox_messages_processor/page" method="post">
    <h1>Delete Some 📥 💬s</h1>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">Ninety day old messages or older will be deleted without your intervention.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($g->inbox_messages_array as $key => $value): ?>
            <label class="checkbox">
                <input type="checkbox" name="choice-<?= $key + 1 ?>" value="<?= $value->id ?>">
                <?= $value->user_id ?> <small>[<?= $value->created ?>]</small>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
