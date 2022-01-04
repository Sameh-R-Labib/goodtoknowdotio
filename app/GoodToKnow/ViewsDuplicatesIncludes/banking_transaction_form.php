<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="<?= $g->action ?>" method="post">
        <h1><?= $g->heading_one ?></h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">A negative (-) amount shall signify money spent.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label (✅ emoji): </label>
                <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                       minlength="3" maxlength="264" size="61" spellcheck="false"
                       placeholder="Internet Service Fee">
            </p>
            <hr>
            <p>Time</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="amount">Amount <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of 8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="amount" name="amount" type="text" value="<?= $g->saved_arr01['amount'] ?>" required
                       minlength="1" maxlength="33" size="33" placeholder="-105.39">
            </p>
        </section>
        <section>
            <?= $g->account_type ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>