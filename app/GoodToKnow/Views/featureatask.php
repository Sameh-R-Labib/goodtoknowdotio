<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/FeatureATaskEdit/page" method="post">
    <h2>Which Task?</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($array as $key => $object): ?>
            <label for="c<?= $key ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                <?= $object->label ?>
            </label>
        <?php endforeach; ?>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>