<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <!-- I will use form tags only for style css issues -->
    <form>
        <h2>Discover Other Communities</h2>
        <?php require SESSIONMESSAGE; ?>
        <p>These are communities on this Gtk.io system which you can ask to join:</p>
        <ul>
            <?php foreach ($g->coms_user_does_not_belong_to as $community): ?>
                <li><b><?= $community->community_name ?></b> ― <?= $community->community_description ?></li>
            <?php endforeach; ?>
        </ul>
        <!-- Button to dismiss this view -->
        <p><a class="modify" href="/ax1/clear_session_vars/page">Home</a></p>
    </form>
<?php require BOTTOMOFPAGES; ?>