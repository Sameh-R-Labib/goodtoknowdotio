<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class RevampABankingTransactionForBalancesUpdate
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted revampabankingtransactionforbalancesedit.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // record id

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Validate the submitted revampabankingtransactionforbalancesedit.php form data.
         *      (and apply htmlspecialchars)
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_amount = (isset($_POST['amount'])) ? (float)$_POST['amount'] : 0.0;

        $edited_time = (isset($_POST['time'])) ? (int)$_POST['time'] : 1560190617;

        $edited_bank_id = (isset($_POST['bank_id'])) ? (int)$_POST['bank_id'] : 0;

        $edited_label = standard_form_field_prep('label', 3, 30);

        if (is_null($edited_label)) {
            $sessionMessage .= " The label you entered did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
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
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $object = BankingTransactionForBalances::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */
        $object->bank_id = $edited_bank_id;
        $object->label = $edited_label;
        $object->amount = $edited_amount;
        $object->time = $edited_time;

        /**
         * 4) Update/save the updated record in the database.
         */
        $result = $object->save($db, $sessionMessage);
        if ($result === false) {
            $sessionMessage .= " I aborted because I failed at saving the updated object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 5) Report success.
         */
        $sessionMessage .= " I've updated the <b>{$object->label}</b> record. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        $_SESSION['saved_int02'] = 0;
        redirect_to("/ax1/Home/page");
    }
}