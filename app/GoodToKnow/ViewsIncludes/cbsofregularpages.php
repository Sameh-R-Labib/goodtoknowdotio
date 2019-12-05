<!-- communities -->
<button type="button" class="collapsible">🧑🏿‍🤝‍🧑🏽&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Communities
    To Choose From
</button>
<div id="communities" class="content">
    <p><?php require COMMUNITIESFORTHISUSER; ?></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p><span style="font-size:19px;">⚓️</span>&nbsp;&nbsp;<?php require BREADCRUMBS; ?>
    </p>
</div>
<!-- scriptoutput -->
<button type="button" class="collapsible">👁️&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View More
    &mldr;
</button>
<div id="scriptoutput" class="content">
    <div id="leftsodiv">
        <?php require MESSAGETHEAUTHOR; ?>
        <div id="admindiv">
            <?php require CONTROLPANELLINK; ?>
        </div>
    </div>
    <div id="scriptmessage">
        <?php require SESSIONMESSAGE; ?>
    </div>
</div>
