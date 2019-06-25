<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingAcctForBalances;


class ViewAllBankingAccountsForBalances
{
    public function page()
    {
        /**
         * Similar to RecurringPaymentSeeMyRecords.
         */

        global $user_id;
        global $sessionMessage;
        global $is_logged_in;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'All my BankingAccountsForBalances';

        $page = 'ViewAllBankingAccountsForBalances';

        $show_poof = true;

        /**
         * Get an array of BankingAcctForBalances objects for the user who has id == $user_id.
         */
        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $array_of_objects = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);
        if (!$array_of_objects || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any banking_acct_for_balances for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         */
        foreach ($array_of_objects as $object) {
            // Transform the start_time to a human readable format.
            $object->start_time = self::get_readable_time($object->start_time);
            $object->comment = nl2br($object->comment, false);
            // Add comma for thousands but keep the number of decimal places at 8 just in case the currency is a crypto.
            $object->start_balance = number_format($object->start_balance, 8);
        }

        $sessionMessage .= ' Enjoy ʘ‿ʘ at all your 🏦ing 📒s for ⚖️s. ';

        require VIEWS . DIRSEP . 'viewallbankingaccountsforbalances.php';
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param $created
     * @return string
     */
    public static function get_readable_time($created)
    {
        $created = (int)$created;
        $date = date('m/d/Y h:ia ', $created) . "<small>[" . date_default_timezone_get() . "]</small>";
        return $date;
    }
}