<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/offline_the_system_proc/page" method="post">
        <h1><?= $g->html_title ?></h1>
        <?php require SESSIONMESSAGE; ?>
        <p>The current system status is: "<?= $g->current_status ?>".<br>
            Do you want to switch to the other status?</p>
        <section>
            <label for="yes" class="radio">
                <input type="radio" id="yes" name="choice" value="yes">
                Yes<br>
            </label>
            <label for="no" class="radio">
                <input type="radio" id="no" name="choice" value="no">
                No
            </label>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>