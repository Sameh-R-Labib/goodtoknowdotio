<?php if ($is_admin): ?>
    <div class="tooltip"><a href="/ax1/AdminHome/page"><img src="/cpicon.png" alt="Admin Panel" height="81"
                                                            width="81"></a>
        <span class="tooltiptext tooltip-top">Admin Control Panel</span>
    </div>
<?php else: ?>
    <div class="tooltip"><a href="/ax1/ControlPanel/page"><img src="/cpicon.png" alt="Admin Panel" height="81"
                                                               width="81"></a>
        <span class="tooltiptext tooltip-top">Control Panel</span>
    </div>
<?php endif; ?>