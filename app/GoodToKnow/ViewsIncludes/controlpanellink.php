<?php if ($is_admin): ?>
    <div class="tooltip"><a href="/ax1/AdminHome/page"><img src="/cpicon.png" alt="Admin Panel" height="86"
                                                            width="108"></a>
        <span class="tooltiptext tooltip-top">Admin Control Panel</span>
    </div>
<?php elseif ($is_guest): ?>
    <div class="tooltip"><img src="/cpicon.png" alt="Admin Panel" height="86" width="108">
        <span class="tooltiptext tooltip-top">Control Panel</span>
    </div>
<?php else: ?>
    <div class="tooltip"><a href="/ax1/ControlPanel/page"><img src="/cpicon.png" alt="Admin Panel" height="86"
                                                               width="108"></a>
        <span class="tooltiptext tooltip-top">Control Panel</span>
    </div>
<?php endif; ?>