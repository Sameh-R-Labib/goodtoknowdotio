<?php require TOPFORFORMPAGES; ?>
<?php global $result; ?>
    <!-- globals declarations (if any) go here -->
    <!-- I will use form tags only for style css issues -->
    <form>
        <h2>Save or Cancel</h2>
        <?php require SESSIONMESSAGE; ?>
        <p>What you see is what will be saved.</p>
        <pre><?php print_r($result); ?></pre>
        <!-- Present link buttons for Save and Cancel -->
    </form>
<?php require BOTTOMOFPAGES; ?>