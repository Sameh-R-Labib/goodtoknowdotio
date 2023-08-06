<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/transfer_an_amount_form_processor/page" method="post">
        <h1>Transfer An Amount of Money Or Commodity</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label: </label>
                <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                       minlength="3" maxlength="264" size="61" spellcheck="false"
                       placeholder="Internet Service Fee">
            </p>
            <hr>
            <p>Time</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="amount">Amount <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">Contact Admin if you are not seeing the correct number of decimal places.</span></span>:
                </label>
                <input id="amount" name="amount" type="text" value="<?= $g->saved_arr01['amount'] ?>" required
                       minlength="1" maxlength="33" size="33" placeholder="105.39">
            </p>
        </section>
        <section>
            <?= $g->sending_account ?>
        </section>
        <section>
            <?= $g->receiving_account ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>