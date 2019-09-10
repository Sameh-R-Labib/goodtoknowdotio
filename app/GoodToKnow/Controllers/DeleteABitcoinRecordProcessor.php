<?php

namespace GoodToKnow\Controllers;

class DeleteABitcoinRecordProcessor
{
    function page()
    {
        /**
         * 1) Determines the id of the bitcoin record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the Bitcoin object with that id from the database.
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_record_of_user.php';


        /**
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */

        // Format the attributes for easy viewing

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        require CONTROLLERINCLUDES . DIRSEP . 'transform_to_readable_the_bitcoin_record.php';

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'deleteabitcoinrecordprocessor.php';
    }
}