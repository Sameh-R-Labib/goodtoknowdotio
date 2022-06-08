<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <!-- I will use form tags only for style css issues -->
    <form action="/ax1/reset_all_b_accounts/page" method="post">
        <h2>Instructions</h2>
        <?php require SESSIONMESSAGE; ?>
        <p>Attention! There is a saying in computer science which says: "garbage in ... garbage out".
            If your bank account record is missing or bad or if the system doesn't have all the transactions
            then don't expect the reset of your bank account to be correct. Otherwise, click Submit to
            proceed with the reset.</p>
        <!-- Present link buttons for Submit and Abort -->
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>