<?php

namespace GoodToKnow\Controllers;

class BitcoinSeeMyRecords
{
    function page()
    {
        global $g;
        global $array_of_bitcoin_objects;

        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_records_of_the_user.php';

        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($array_of_bitcoin_objects as $g->bitcoin_object) {

            require CONTROLLERINCLUDES . DIRSEP . 'transform_to_readable_the_bitcoin_record.php';

        }


        /**
         * Present the view.
         */

        $g->html_title = 'Your ₿ records';

        $g->page = 'BitcoinSeeMyRecords';

        $g->show_poof = true;

        $g->message .= ' Here are your ₿ records. ';

        require VIEWS . DIRSEP . 'bitcoinseemyrecords.php';
    }
}