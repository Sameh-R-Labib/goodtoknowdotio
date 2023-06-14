<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/delete_recent_uploads_processor/page" method="post">
    <h1><?= $g->html_title ?></h1>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">It deletes uploads from server's image subdirectory.</span>
    </p>
    <p><b>Choose Ones To Delete</b></p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($g->array_of_objects as $key => $value): ?>
            <label class="checkbox">
                <input type="checkbox" name="choice-<?= $key + 1 ?>" value="<?= $value->id ?>">
                🕒 <?= $value->time ?> 🙍 <?= $value->author_username ?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;🔍 <?= $value->name ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
