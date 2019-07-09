<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingTransactionForBalances;


class RevampABankingTransactionForBalancesChooseRecord
{
    public function page()
    {
        /**
         * This function will:
         *  1) Retrieve the user's BankingTransactionForBalances within the time range.
         *  2) Present them as choices.
         *
         * The ultimate goal is to present a BankingTransactionForBalances for editing.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $saved_int01;     // min time
        global $saved_int02;     // max time

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Get an array of BankingTransactionForBalances objects belonging to the user
         * and falling within the prescribed time range.
         */
        $sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $sql .= ' AND `time` BETWEEN "' . $db->real_escape_string($saved_int02) . '" AND "' . $db->real_escape_string($saved_int01) . '"';
        $sql .= ' ORDER BY `time`';
        $array = BankingTransactionForBalances::find_by_sql($db, $sessionMessage, $sql);
        if (!$array || !empty($sessionMessage)) {


            /**
             * Debug Code
             */
            echo "\n<p>Begin debug</p>\n";
            echo "<br><p>Var_dump \$array: </p>\n<pre>";
            var_dump($array);
            echo "</pre>\n";
            echo "<br><p>Print_r \$sql: </p>\n<pre>";
            print_r($sql);
            echo "</pre>\n";
            die("<br><p>End debug</p>\n");




            $sessionMessage .= ' 🤔 I could NOT find any banking_transaction_for_balances records for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Replace time with a human readable time.
         */
        foreach ($array as $object) {
            $object->time = self::get_readable_time($object->time);
        }

        $html_title = 'Which banking_transaction_for_balances record?';

        require VIEWS . DIRSEP . 'revampabankingtransactionforbalanceschooserecord.php';
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