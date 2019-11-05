<!-- communities -->
<button type="button" class="collapsible">🧑🏿‍🤝‍🧑🏽</button>
<div id="communities" class="content">
    <p><?php require COMMUNITIESFORTHISUSER; ?></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p><span style="font-size:26px;">↘️</span> <?php require BREADCRUMBS; ?>
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
        <?php require SESSIONMESSAGE; ?>
    </div>
</div>
