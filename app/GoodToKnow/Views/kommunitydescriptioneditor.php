<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/KommunityDescriptionEditorProcessor/page" method="post">
    <h2>Enter the Name of Community</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="community">Community: </label>
            <input id="community" name="community" type="text" required minlength="1" maxlength="200" size="22"
                   spellcheck="false">
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>