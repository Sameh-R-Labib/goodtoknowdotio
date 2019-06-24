<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingAcctForBalances;

class PopulateABankingAccountForBalancesSubmit
{
    public function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted populateabankingaccountforbalancesprocessor.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // recurring_payment record id

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Validate the submitted populateabankingaccountforbalancesprocessor.php form data.
         *      (and apply htmlspecialchars)
         */
        if (!isset($_POST['submit'])) {
            $sessionMessage .= " Error 12730. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $edited_acct_name = (isset($_POST['acct_name'])) ? $_POST['acct_name'] : "";
        $edited_start_time = (isset($_POST['start_time'])) ? (int)$_POST['start_time'] : 1560190617;
        $edited_start_balance = (isset($_POST['start_balance'])) ? (float)$_POST['start_balance'] : 0;
        $edited_comment = (isset($_POST['comment'])) ? $_POST['comment'] : "";
        // make sure the comment is okay.
        $result = self::is_comment($sessionMessage, $edited_comment);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because the comment text submitted did not comply. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $edited_acct_name = htmlspecialchars($edited_acct_name);

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
        $object = BankingAcctForBalances::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that banking_acct_for_balances record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */
        $object->acct_name = $edited_acct_name;
        $object->start_time = $edited_start_time;
        $object->start_balance = $edited_start_balance;
        $object->comment = $edited_comment;

        /**
         * 4) Update/save the updated record in the database.
         */
        $result = $object->save($db, $sessionMessage);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because I failed at saving the updated BankingAcctForBalances object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Report success.
         */
        $sessionMessage .= " I've successfully updated BankingAcctForBalances <b>{$object->acct_name}</b>'s record. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        redirect_to("/ax1/Home/page");
    }

    /**
     * @param $message
     * @param string $comment
     * @return bool
     */
    public static function is_comment(string &$message, string &$comment)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be less than 800 characters long.
         * Can't contain any html tags
         */
        $comment = trim($comment);

        if (empty($comment)) {
            $message .= " Your comment is missing. ";
            return false;
        }

        $length = strlen($comment);
        if ($length > 800) {
            $message .= " Your comment is too long. ";
            return false;
        }

        if ($comment != strip_tags($comment)) {
            $message .= " Your comment includes html. We don't allow that in this field. ";
            return false;
        }

        return true;
    }
}