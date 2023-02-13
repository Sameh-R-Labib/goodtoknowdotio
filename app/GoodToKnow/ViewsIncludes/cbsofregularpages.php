<?php global $g; ?>
<!-- communities -->
<button type="button" class="collapsible">🧑🏿‍🤝‍🧑🏽&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <img src="/switcharoo.gif" alt="switch communities" height="24" width="24">
</button>
<div id="communities" class="content">
    <p><?php require COMMUNITIESFORTHISUSER; ?></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p><span style="font-size:16px;">⚓️</span>&nbsp;&nbsp;<?php require BREADCRUMBS; ?>
    </p>
</div>
<!-- scriptoutput -->
<div id="scriptoutput">
    <div id="leftsodiv">
        <?php require MESSAGETHEAUTHOR; ?>
        <div id="admindiv">
            <?php require CONTROLPANELLINK; ?>
        </div>
    </div>
    <div id="scriptmessage">
        <div id="the-message">
            <?php require SESSIONMESSAGE; ?>
        </div>
        <div id="the-buttons">
            <p><?= $g->the_buttons ?></p>
        </div>
    </div>
</div>
