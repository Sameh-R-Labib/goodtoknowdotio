<?php

namespace GoodToKnow\Controllers;

class BitcoinSeeMyRecords
{
    function page()
    {
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;

        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_records_of_the_user.php';

        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        /** @noinspection PhpUndefinedVariableInspection */

        foreach ($array_of_bitcoin_objects as $bitcoin_object) {

            require CONTROLLERINCLUDES . DIRSEP . 'transform_to_readable_the_bitcoin_record.php';

        }

        $html_title = 'Your ₿ records';

        $page = 'BitcoinSeeMyRecords';

        $show_poof = true;

        /** @noinspection PhpUndefinedVariableInspection */

        $sessionMessage .= ' Here are your ₿ records. ';

        require VIEWS . DIRSEP . 'bitcoinseemyrecords.php';
    }
}