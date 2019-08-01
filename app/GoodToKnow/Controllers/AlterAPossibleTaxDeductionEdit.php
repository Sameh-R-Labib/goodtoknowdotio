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
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Store the submitted possible_tax_deduction id in the session.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $id;

        /**
         * 2) Retrieve the possible_tax_deduction object with that id from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $object = PossibleTaxDeduction::find_by_id($db, $sessionMessage, $id);
        if (!$object) {
            $sessionMessage .= " Unexpectedly, I could not find that possible_tax_deduction record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Present a form which is populated with data from the possible_tax_deduction object.
         */
        $html_title = 'Edit the possible_tax_deduction record';

        require VIEWS . DIRSEP . 'alterapossibletaxdeductionedit.php';
    }
}