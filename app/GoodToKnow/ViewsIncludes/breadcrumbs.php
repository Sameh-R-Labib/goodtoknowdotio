<?php if ($page === 'Inbox') {
    echo "<a href=\"/ax1/Inbox/page\">Inbox</a>";
} else {
    require CURRENTCOMMUNITY;
    require CURRENTTOPIC;
    require CURRENTPOST;
} ?>