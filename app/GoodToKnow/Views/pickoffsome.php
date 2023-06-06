<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/pick_off_some_processor/page" method="post">
    <h1><?= $g->html_title ?></h1>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">Feature "Pick Off Some" is a compliment to "Cull The Herd".</span>
    </p>
    <p><b>Choose Ones To Delete</b></p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($g->array_of_objects as $key => $value): ?>
            <label class="checkbox">
                <input type="checkbox" name="choice-<?= $key + 1 ?>" value="<?= $value->id ?>">
                🕒 <?= $value->time ?> 🙍 <?= $value->author_username ?><br>
                &nbsp;&nbsp;&nbsp;🔍 <?= $value->name ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
    <?php require BOTTOMOFPAGES; ?>
