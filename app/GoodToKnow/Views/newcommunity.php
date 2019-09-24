<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/NewCommunityProcessor/page" method="post">
    <h1>Create 🧑🏿‍🤝‍🧑🏽</h1>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">⚠️ all fields required ✅ emoji</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <p>Details of Community To Be Created</p>
    <section>
        <p>
            <label for="name">Name: </label>
            <input id="name" name="community_name" type="text" value="" required minlength="1" maxlength="200"
                   size="61" spellcheck="false">
        </p>
        <p>
            <label for="description">Description: </label>
            <input id="description" name="community_description" type="text" value="" required minlength="1"
                   maxlength="230" size="61" spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
