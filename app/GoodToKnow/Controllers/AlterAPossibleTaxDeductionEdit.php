<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;

class AlterAPossibleTaxDeductionEdit
{
    function page()
    {
        /**
         * 1) Store the submitted possible_tax_deduction id in the session.
         * 2) Retrieve the possible_tax_deduction object with that id from the database.
         * 3) Present a form which is populated with data from the possible_tax_deduction object.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' I aborted the task. ');
        }

        /**
         * 1) Store the submitted possible_tax_deduction id in the session.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($id)) {
            breakout(' Your choice did not pass validation. ');
        }

        $_SESSION['saved_int01'] = $id;

        /**
         * 2) Retrieve the possible_tax_deduction object with that id from the database.
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

        $object = PossibleTaxDeduction::find_by_id($db, $sessionMessage, $id);

        if (!$object) {
            breakout(' Unexpectedly, I could not find that possible tax deduction. ');
        }

        /**
         * 3) Present a form which is populated with data from the possible_tax_deduction object.
         */
        $html_title = 'Edit the possible_tax_deduction record';

        require VIEWS . DIRSEP . 'alterapossibletaxdeductionedit.php';
    }
}