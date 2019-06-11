<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;


class BitcoinSeeMyRecords
{
    public function page()
    {
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

        $html_title = 'Show Me My Bitcoin Records';

        $page = 'BitcoinSeeMyRecords';

        $show_poof = true;

        /**
         * Get an array of Bitcoin objects for the user who has id == $user_id.
         */
        $sql = 'SELECT * FROM `bitcoin` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $array_of_bitcoin_objects = Bitcoin::find_by_sql($db, $sessionMessage, $sql);
        if (!$array_of_bitcoin_objects || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any bitcoin records for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         */
        foreach ($array_of_bitcoin_objects as $bitcoin_object) {
            $bitcoin_object->unix_time_at_purchase = self::get_readable_time($bitcoin_object->unix_time_at_purchase);
        }

        $sessionMessage .= ' Enjoy ʘ‿ʘ at your ₿💰. ';

        require VIEWS . DIRSEP . 'bitcoinseemyrecords.php';
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