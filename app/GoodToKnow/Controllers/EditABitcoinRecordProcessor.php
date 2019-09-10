<?php

namespace GoodToKnow\Controllers;

class EditABitcoinRecordProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted bitcoin record id in the session.
         * 2) Retrieve the object with that id from the database.
         * 3) Present a form which is populated with data from the object. (except the bitcoin address should not be changeable.)
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_record_of_user.php';


        /**
         * 3) Present a form which is populated with data from the object.
         *    (except do the bitcoin address should not be changeable.)
         */

        $html_title = 'Edit the bitcoin record';

        require VIEWS . DIRSEP . 'editabitcoinrecordprocessor.php';
    }
}