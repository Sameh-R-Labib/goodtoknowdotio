<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class DeleteABitcoinRecordProcessor
{
    function page()
    {
        /**
         * 1) Determines the id of the bitcoin record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the Bitcoin object with that id from the database.
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */

        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Determines the id of the bitcoin record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $_SESSION['saved_int01'] = $chosen_id;


        /**
         * 2) Retrieve the Bitcoin object with that id from the database.
         */

        $db = get_db();

        $bitcoin_object = Bitcoin::find_by_id($db, $sessionMessage, $chosen_id);

        if (!$bitcoin_object) {

            breakout(' Unexpectedly I could not find that bitcoin record. ');

        }


        // Format the attributes for easy viewing

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        $bitcoin_object->time = get_readable_time($bitcoin_object->time);
        $bitcoin_object->comment = nl2br($bitcoin_object->comment, false);
        $bitcoin_object->price_point = readable_amount_of_money($bitcoin_object->currency, $bitcoin_object->price_point);


        // Since we know these two are crypto we don't need to use readable_amount_of_money()

        $bitcoin_object->initial_balance = number_format($bitcoin_object->initial_balance, 8);
        $bitcoin_object->current_balance = number_format($bitcoin_object->current_balance, 8);


        /**
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'deleteabitcoinrecordprocessor.php';
    }
}