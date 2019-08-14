<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class BuildABankingTransactionForBalancesProcessor
{
    function page()
    {
        /**
         * Create a database record in the banking_transaction_for_balances
         * table using the submitted banking_transaction_for_balances
         * label and time. The remaining field values will be set to default values.
         *
         * $_POST['label'] $_POST['time']
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 30);

        if (is_null($label)) {
            $sessionMessage .= " The label you entered did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $time = (isset($_POST['time'])) ? $_POST['time'] : '';

        if (empty(trim($time))) {
            $sessionMessage .= " Either you did not fill out the input fields or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (strlen($time) > 22 || strlen($time) < 10) {
            $sessionMessage .= " Either the time's string length is too long or too short. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


        // Remove this once i switch to using integer_form_field_prep()
        $time = (int)$time;


        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Create a BankingTransactionForBalances array for the record.
         */
        $array_record = ['user_id' => $user_id, 'bank_id' => 0, 'label' => $label, 'amount' => 0, 'time' => $time];

        /**
         * Make the array into an in memory BankingTransactionForBalances object for the record.
         */
        $object = BankingTransactionForBalances::array_to_object($array_record);

        /**
         * Save the object.
         */
        $result = $object->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= ' The save method for BankingTransactionForBalances returned false. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (!empty($sessionMessage)) {
            $sessionMessage .= ' The save method for BankingTransactionForBalances did not return false but it did send
            back a message. Therefore, it probably did not create the BankingTransactionForBalances record. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Wrap it up.
         */
        $sessionMessage .= " A Banking Transaction For Balances was created! ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}