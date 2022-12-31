<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <!-- I will use form tags only for style css issues -->
    <form>
        <h1>Save or Cancel</h1>
        <?php require SESSIONMESSAGE; ?>
        <p><b>What you see is what will be saved:</b></p>
        <h2>$g->sold_remaining</h2>
        <p><b>Sold Remaining: </b><?= $g->sold_remaining ?></p>

        <!-- Present link buttons for Save and Abort -->
        <p><a class="save" href="/ax1/process_a_commodity_sale_generate_changes_save/page">Save</a>
            <a class="abort" href="/ax1/clear_session_vars/page">Abort</a></p>
    </form>
<?php require BOTTOMOFPAGES; ?>