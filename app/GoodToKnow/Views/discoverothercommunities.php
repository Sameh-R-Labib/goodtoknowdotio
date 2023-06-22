<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <!-- I will use form tags only for style css issues -->
    <form>
        <h2>Discover Other Communities</h2>
        <?php require SESSIONMESSAGE; ?>
        <p>These are communities on this Gtk.io system which you can ask to join:</p>
        <ul>
            <?php foreach ($g->coms_user_does_not_belong_to as $community): ?>
                <li><em><?= $community->community_name ?></em> ― <?= $community->community_description ?></li>
            <?php endforeach; ?>
        </ul>
        <!-- Button to dismiss this view -->
        <p><a class="no-frills-link" href="/ax1/clear_session_vars/page/<?= $g->controller_name ?>"><img
                        src="/img/blog_home.gif" alt="blog home" height="18" width="18"></a></p>
    </form>
<?php require BOTTOMOFPAGES; ?>