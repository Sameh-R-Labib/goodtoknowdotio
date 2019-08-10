<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingAcctForBalances;
use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class RevampABankingTransactionForBalancesEdit
{
    function page()
    {
        /**
         * 1) Store the submitted banking_transaction_for_balances record id in the session.
         * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
         * 3) Present a form which is populated with data from the banking_transaction_for_balances object.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

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
         * 1) Store the submitted banking_transaction_for_balances record id in the session.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $object = BankingTransactionForBalances::find_by_id($db, $sessionMessage, $chosen_id);
        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that banking_transaction_for_balances record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Present a form which is populated with data from the banking_transaction_for_balances object.
         *
         * Note: Replace bank_id with the HTML for the drop down select box. Then use bank_id in the HTML form
         * to supply the HTML for that input field.
         */
        $object->bank_id = self::get_html_select_box_containing_the_bank_accounts($db, $sessionMessage, $user_id, $object->bank_id);

        // Handle a failed call to the function above
        if (!$object->bank_id OR !empty($sessionMessage)) {
            $sessionMessage .= " Unexpectedly error number 014332. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Edit the banking_transaction_for_balances record';

        require VIEWS . DIRSEP . 'revampabankingtransactionforbalancesedit.php';
    }

    /**
     * @param \mysqli $db
     * @param string $sessionMessage
     * @param int $user_id
     * @param int $bank_id
     * @return bool|string
     */
    public static function get_html_select_box_containing_the_bank_accounts(\mysqli $db, string &$sessionMessage, int $user_id, int $bank_id)
    {
        /**
         * The current bank account will be pre selected.
         *
         * This is what HTML for a drop down looks like:
         *         <label for="bank_id" class="dropdown">Bank Account:
         *             <select id="bank_id" name="bank_id">
         *                 <option value="4">Citibank checking</option>
         *                 <option value="7" selected>Bank of America CC</option>
         *             </select>
         *        </label>
         */
        $html = "        <label for=\"bank_id\" class=\"dropdown\">Bank Account:\n";
        $html .= "             <select id=\"bank_id\" name=\"bank_id\">\n";

        /**
         * First I need to get all the BankingAcctForBalances object for this user.
         */
        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $array_of_objects = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);
        if (!$array_of_objects || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any banking_acct_for_balances for you ¯\_(ツ)_/¯. ';
            return false;
        }

        /**
         * Build the options.
         */
        foreach ($array_of_objects as $object) {
            $html .= "                 <option value=\"";
            $html .= $object->id;
            if ($object->id == $bank_id) {
                $html .= "\" selected>";
            } else {
                $html .= "\">";
            }
            $html .= $object->acct_name;
            $html .= "</option>\n";
        }

        /**
         * Close the HTML.
         */
        $html .= "             </select>\n";
        $html .= "        </label>\n";

        return $html;
    }
}