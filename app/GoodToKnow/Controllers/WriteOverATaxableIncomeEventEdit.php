<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class WriteOverATaxableIncomeEventEdit
{
    function page()
    {
        /**
         * 1) Store the submitted taxable_income_event id in the session.
         * 2) Retrieve the taxable_income_event object with that id from the database.
         * 3) Present a form which is populated with data from the taxable_income_event object.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Store the submitted taxable_income_event id in the session.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $id;

        /**
         * 2) Retrieve the taxable_income_event object with that id from the database.
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $object = TaxableIncomeEvent::find_by_id($db, $sessionMessage, $id);

        if (!$object) {
            $sessionMessage .= " Unexpectedly, I could not find that taxable income event's record. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Present a form which is populated with data from the taxable_income_event object.
         */
        $html_title = 'Edit the taxable income event\'s record';

        require VIEWS . DIRSEP . 'writeoverataxableincomeeventedit.php';
    }
}