<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form>
    <h1>Transfer Post Ownership</h1>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">Your goal here is to specify which post to transfer ownership of.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <p>Choose the topic where the post resides.</p>
    <section>
        <?php foreach ($g->special_topic_array as $key => $value): ?>
            <a href="/ax1/transfer_post_ownership_processor/page/<?= $key ?>" class="choose"><?= $value ?></a>
        <?php endforeach; ?>
    </section>
    <?php require ABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
