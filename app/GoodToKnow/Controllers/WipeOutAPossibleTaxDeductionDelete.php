<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;


class WipeOutAPossibleTaxDeductionDelete
{
    function page()
    {
        /**
         * 1) Store the submitted possible_tax_deduction record id in the session.
         * 2) Retrieve the possible_tax_deduction object with that id from the database.
         * 3) Present a form which is populated with data from the possible_tax_deduction object
         *    and asks for approval for deletion to proceed.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Store the submitted possible_tax_deduction record id in the session.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $chosen_id;

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

        $object = PossibleTaxDeduction::find_by_id($db, $sessionMessage, $chosen_id);
        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that possible_tax_deduction record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         *  3) Present a form which is populated with data from the possible_tax_deduction object
         *    and asks for approval for deletion to proceed.
         */
        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'wipeoutapossibletaxdeductiondelete.php';
    }
}