<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/KommunityDescriptionEditorProcessor/page" method="post">
    <h1>🧑🏿‍🤝‍🧑🏽 Description Editor</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Enter the Name of Community</p>
    <section>
        <p>
            <label for="community">Community: </label>
            <input id="community" name="community" type="text" required minlength="1" maxlength="200" size="22"
                   spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>