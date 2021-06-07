<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/WipeOutAPossibleTaxDeductionConfirmation/page" method="post">
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Label: </b><?php echo $g->object->label; ?></p>
        <p><b>Year Paid: </b><?= $g->object->year_paid ?></p>
        <p><?= $g->object->comment ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
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