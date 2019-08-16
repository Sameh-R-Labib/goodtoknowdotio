<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class PolishARecurringPaymentRecordSubmit
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted polisharecurringpaymentrecordprocessor.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // recurring_payment id

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Validate the submitted polisharecurringpaymentrecordprocessor.php form data.
         *      (and apply htmlspecialchars)
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        /** @var $edited_label */

        $edited_label = standard_form_field_prep('label', 4, 264);

        /** @var  $edited_currency */

        $edited_currency = standard_form_field_prep('currency', 1, 15);

        /** @var  $edited_amount_paid */

        $edited_amount_paid = (isset($_POST['amount_paid'])) ? (float)$_POST['amount_paid'] : 0.0;

        /** @var $edited_time */

        $edited_time = integer_form_field_prep('unix_time_at_last_payment', 0, PHP_INT_MAX);

        if (is_null($edited_time)) {
            $sessionMessage .= " Your time value did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if ($edited_time === 0) {
            $edited_time = 1560190617;
        }

        /** @var $edited_comment */

        $edited_comment = standard_form_field_prep('comment', 0, 800);

        if (is_null($edited_comment) || is_null($edited_label) || is_null($edited_currency)) {
            $sessionMessage .= " One or more values you entered did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Retrieve the existing record from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $object = RecurringPayment::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that recurring_payment record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */
        $object->label = $edited_label;
        $object->currency = $edited_currency;
        $object->amount_paid = $edited_amount_paid;
        $object->unix_time_at_last_payment = $edited_time;
        $object->comment = $edited_comment;

        /**
         * 4) Update/save the updated record in the database.
         */
        $result = $object->save($db, $sessionMessage);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because I failed at saving the updated RecurringPayment object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 5) Report success.
         */
        $sessionMessage .= " I've updated <b>{$object->label}</b>. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        redirect_to("/ax1/Home/page");
    }
}