<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <!-- I will use form tags only for style css issues -->
    <form>
        <h2>Save or Cancel</h2>
        <?php require SESSIONMESSAGE; ?>
        <p><b>What you see is what will be saved:</b></p>
        <?= $g->present ?>
        <!-- Present link buttons for Save and Abort -->
        <p><a class="save" href="/ax1/BalanceOutTheSequenceNumbersSave/page">Save</a>
            <a class="abort" href="/ax1/ClearSessionVars/page">Abort</a></p>
    </form>
<?php require BOTTOMOFPAGES; ?>