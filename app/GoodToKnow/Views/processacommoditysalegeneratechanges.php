<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <!-- I will use form tags only for style css issues -->
    <form>
        <h1>Save or Cancel</h1>
        <?php require SESSIONMESSAGE; ?>
        <p><b>What you see is what will be saved:</b></p>
        <h2>That Which Will Not Be Expensed</h2>
        <p><b>Sold Remaining: </b><?= $g->saved_arr01["commodity"] ?><?= $g->sold_remaining ?></p>
        <?php foreach ($g->array_of_commodity_objects as $key => $commodity): ?>
            <h2>#<?= $key ?> Commodity</h2>
            <p><b>Time of purchase: </b><?= $commodity->time ?><br>
                <b>Address / Label: </b><?= $commodity->address ?><br>
                <b>Price of 1<?= $commodity->commodity ?> at 🕒 of purchase: </b><?= $commodity->currency ?>
                &nbsp;<?= $commodity->price_point ?><br>
                <b>Initial Balance: </b><?= $commodity->commodity ?>&nbsp;<?= $commodity->initial_balance ?><br>
                <b>Current Balance: </b><?= $commodity->commodity ?>&nbsp;<?= $commodity->current_balance ?><br>
                <?= $commodity->comment ?></p>
            <h2>#<?= $key ?> Commodity Sold</h2>

        <?php endforeach; ?>
        <!-- Present link buttons for Save and Abort -->
        <p><a class="save" href="/ax1/process_a_commodity_sale_generate_changes_save/page">Save</a>
            <a class="abort" href="/ax1/clear_session_vars/page">Abort</a></p>
    </form>
<?php require BOTTOMOFPAGES; ?>