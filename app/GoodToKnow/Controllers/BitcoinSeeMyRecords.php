<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class BitcoinSeeMyRecords
{
    function page()
    {
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;

        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_records_of_the_user.php';

        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        /** @noinspection PhpUndefinedVariableInspection */

        foreach ($array_of_bitcoin_objects as $bitcoin_object) {
            $bitcoin_object->time = get_readable_time($bitcoin_object->time);

            $bitcoin_object->comment = nl2br($bitcoin_object->comment, false);

            $bitcoin_object->price_point = readable_amount_of_money($bitcoin_object->currency, $bitcoin_object->price_point);

            // Since we know these two are crypto we don't need to use readable_amount_of_money()
            $bitcoin_object->initial_balance = number_format($bitcoin_object->initial_balance, 8);
            $bitcoin_object->current_balance = number_format($bitcoin_object->current_balance, 8);
        }

        $html_title = 'Enjoy ʘ‿ʘ at your ₿.';

        $page = 'BitcoinSeeMyRecords';

        $show_poof = true;

        $sessionMessage .= ' Enjoy ʘ‿ʘ at your ₿ 📽s. ';

        require VIEWS . DIRSEP . 'bitcoinseemyrecords.php';
    }
}