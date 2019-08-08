<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <?php if (!empty($array_of_recurring_payment_objects)): ?>
            <?php $last = count($array_of_recurring_payment_objects) - 1; ?>
            <?php foreach ($array_of_recurring_payment_objects as $key => $object): ?>
                <h2 class="topofpage"><?= $object->label ?></h2>
                <p><b>Last's 🕒: </b><?= $object->unix_time_at_last_payment ?></p>
                <p><?= $object->currency ?>&nbsp;<?= $object->amount_paid ?></p>
                <p><?= $object->comment ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no recurring payments for you.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
    <!-- footerbar -->
    <div id="footerbar">
        <p align="center" style="font-size: 1em;">
            <img src="/Gnu-head-30-years-anniversary.svg" style="float:left;height: 32px;width: 32px;margin-top: -6px">
            © 2018 - Sameh Ramzy Labib
            <img src="/2000px-GPLv3_Logo.svg.png"
                 height="32" width="70"
                 style="float:right;;margin-top: -6px"></p>
    </div>
<?php require BOTTOMOFPAGES; ?>