<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\readable_amount_no_commas;

class EditABitcoinRecordProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted bitcoin record id in the session.
         * 2) Retrieve the object with that id from the database.
         * 3) Verify that this object belongs to the user.
         * 4) Present a form which is populated with data from the object. (except the bitcoin address should not be changeable.)
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->html_title = 'Edit the bitcoin record';


        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_record_of_user.php';


        /**
         * 4) Present a form which is populated with data from the object.
         */


        /**
         * Make it so that if price_point is fiat then price_point has only two decimal places.
         */

        require CONTROLLERHELPERS . DIRSEP . 'readable_amount_no_commas.php';

        $g->bitcoin_object->price_point = readable_amount_no_commas($g->bitcoin_object->currency, $g->bitcoin_object->price_point);


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead, we derive an array called $g->time from it and use $g->time to pre-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $g->time = get_date_h_m_s_from_a_timestamp($g->bitcoin_object->time);


        /**
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['address'] = $g->bitcoin_object->address;
        $g->saved_arr01['initial_balance'] = $g->bitcoin_object->initial_balance;
        $g->saved_arr01['current_balance'] = $g->bitcoin_object->current_balance;
        $g->saved_arr01['currency'] = $g->bitcoin_object->currency;
        $g->saved_arr01['price_point'] = $g->bitcoin_object->price_point;
        $g->saved_arr01['comment'] = $g->bitcoin_object->comment;
        $g->saved_arr01['date'] = $g->time['date'];
        $g->saved_arr01['hour'] = $g->time['hour'];
        $g->saved_arr01['minute'] = $g->time['minute'];
        $g->saved_arr01['second'] = $g->time['second'];
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;

        require VIEWS . DIRSEP . 'editabitcoinrecordprocessor.php';
    }
}