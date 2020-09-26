<?php

namespace GoodToKnow\Controllers;

class InitializeABitcoinRecord
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the
         * bitcoin table. The process will ask the user to ONLY supply a bitcoin
         * address and the remaining field values will be supplied by an (not included)
         * editor for the record.
         */

        /**
         * This here script simply presents a form for the user to supply the bitcoin
         * address for the "to be created" bitcoin record.
         */

        global $sessionMessage;

        global $html_title;

        global $timezone;

        kick_out_loggedoutusers();

        $html_title = 'Create a New Bitcoin Record';

        require VIEWS . DIRSEP . 'initializeabitcoinrecord.php';
    }
}