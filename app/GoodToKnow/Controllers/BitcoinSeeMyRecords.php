<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;


class BitcoinSeeMyRecords
{
    function page()
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
         * And apply htmlspecialchars if necessary.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        foreach ($array_of_bitcoin_objects as $bitcoin_object) {
            $bitcoin_object->unix_time_at_purchase = get_readable_time($bitcoin_object->unix_time_at_purchase);
            $bitcoin_object->comment = nl2br($bitcoin_object->comment, false);
            require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
            $bitcoin_object->price_point = readable_amount_of_money($bitcoin_object->price_point);
            $bitcoin_object->initial_balance = number_format($bitcoin_object->initial_balance, 8);
            $bitcoin_object->current_balance = number_format($bitcoin_object->current_balance, 8);
        }

        $html_title = 'Enjoy ʘ‿ʘ at your ₿💰.';

        $sessionMessage .= ' Enjoy ʘ‿ʘ at your ₿💰. ';

        require VIEWS . DIRSEP . 'bitcoinseemyrecords.php';
    }
}