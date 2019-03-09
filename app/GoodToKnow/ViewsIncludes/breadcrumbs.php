<?php if ($page === 'Inbox') echo "<a href=\"/ax1/Inbox/page\">Inbox</a>";
elseif ($page === 'Admin') echo "<a href=\"/ax1/AdminHome/page\">Admin Home</a>";
elseif ($page === 'CP') echo "<a href=\"/ax1/ControlPanel/page\">Control Panel</a>";
elseif ($page === 'UserRoster') echo "<a href=\"/ax1/UserRoster/page\">User Roster</a>";
else {
    require CURRENTCOMMUNITY;
    require CURRENTTOPIC;
    require CURRENTPOST;
} ?>