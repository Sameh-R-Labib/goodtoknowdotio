<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\RecurringPayment;


class RecurringPaymentSeeMyRecords
{
    function page()
    {
        /**
         * Similar to BitcoinSeeMyRecords.
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

        $html_title = 'Show Me my Recurring Payments';

        $page = 'RecurringPaymentSeeMyRecords';

        $show_poof = true;

        /**
         * Get an array of RecurringPayment objects for the user who has id == $user_id.
         */
        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $array_of_recurring_payment_objects = RecurringPayment::find_by_sql($db, $sessionMessage, $sql);
        if (!$array_of_recurring_payment_objects || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any recurring payments for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */
        foreach ($array_of_recurring_payment_objects as $object) {
            $object->label = htmlspecialchars($object->label);
            $object->currency = htmlspecialchars($object->currency);
            $object->unix_time_at_last_payment = self::get_readable_time($object->unix_time_at_last_payment);
            $object->comment = nl2br($object->comment, false);
            require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
            $object->amount_paid = readable_amount_of_money($object->amount_paid);
        }

        $html_title = 'Enjoy ʘ‿ʘ at your 🌀 💳 📽s.';

        $sessionMessage .= ' Enjoy ʘ‿ʘ at your 🌀 💳 📽s. ';

        require VIEWS . DIRSEP . 'recurringpaymentseemyrecords.php';
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