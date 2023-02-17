<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Create a Blog Post</h1>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">These are the topics in your current community.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>Which <em>topic</em> do you want the new <em>post</em> to live in?</p>
        <section>
            <?php foreach ($g->special_topic_array as $key => $value): ?>
                <a href="/ax1/create_new_post_processor/page/<?= $key ?>" class="choose"><?= $value ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>