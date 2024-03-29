<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity;
use function GoodToKnow\ControllerHelpers\commodity_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class edit_a_commodity_record_submit
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted form data.
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         */


        global $g;
        // $g->saved_int01 commodity record id


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * 1) Validate the submitted form data.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'commodity_address_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        // address

        $address = commodity_address_form_field_prep('address');


        // commodity

        $commodity = standard_form_field_prep('commodity', 1, 15);


        // initial_balance

        // I used -0.0000000000000001 instead of 0.0 to avoid float comparison with zero.
        $initial_balance = float_form_field_prep('initial_balance', -0.0000000000000001, 21000000000.0);


        // current_balance

        // I used -0.0000000000000001 instead of 0.0 to avoid float comparison with zero.
        $current_balance = float_form_field_prep('current_balance', -0.0000000000000001, 21000000000.0);


        // currency

        $currency = standard_form_field_prep('currency', 1, 15);


        // price_point

        // I used -0.0000000000000001 instead of 0.0 to avoid float comparison with zero.
        $price_point = float_form_field_prep('price_point', -0.0000000000000001, 99999999999999.99);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        // For viewing the records we need these
        $_SESSION['saved_int02'] = (int)$g->time;
        $_SESSION['saved_str01'] = $commodity;


        // comment

        $comment = standard_form_field_prep('comment', 0, 1800);


        /**
         * Redirect to give the user one chance to fix their time entry.
         * A correct time entry for a commodity record would be in the past.
         *
         * The currently submitted form data will be used to conveniently
         * populate the redo form.
         *
         * As you see in the code there is a mechanism which causes what we are
         * doing here to happen only once for the submitted data set. In other
         * words the first time the user submits his data set we will check it
         * and give him a chance to fix it. On the subsequent submit we will
         * just let the submitted data be saved.
         */

        if ($g->is_first_attempt) {

            if ($g->time > time()) {

                /**
                 * Reset 'is_first_attempt' in the session.
                 *
                 * We are setting 'is_first_attempt' to false so that once the user submits the form,
                 * and it is being processed it will not be retested for anomalous time entries.
                 */

                $_SESSION['is_first_attempt'] = false;


                // Put form data in an array to prepare it to be stored in $_SESSION['saved_arr01'].
                $saved_arr01['address'] = $address;
                $saved_arr01['commodity'] = $commodity;
                $saved_arr01['initial_balance'] = $initial_balance;
                $saved_arr01['current_balance'] = $current_balance;
                $saved_arr01['currency'] = $currency;
                $saved_arr01['price_point'] = $price_point;
                $saved_arr01['comment'] = $comment;
                $saved_arr01['date'] = $g->date;
                $saved_arr01['hour'] = $g->hour;
                $saved_arr01['minute'] = $g->minute;
                $saved_arr01['second'] = $g->second;
                $saved_arr01['timezone'] = $g->timezone; // this is the actual timezone the user had entered


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/edit_a_commodity_record_redo/page");

            }

        }


        /**
         * Reset 'is_first_attempt' in the session.
         *
         * We need to set it to true so the next time the user creates a task
         * he will have the same opportunity to have his data checked.
         */

        $_SESSION['is_first_attempt'] = true;


        /**
         * 2) Retrieve the existing record from the database.
         */

        get_db();

        $g->commodity_object = commodity::find_by_id($g->saved_int01);

        if (!$g->commodity_object) {

            breakout(' Unexpectedly I could not find that commodity record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $g->commodity_object->address = $address;
        $g->commodity_object->commodity = $commodity;
        $g->commodity_object->initial_balance = $initial_balance;
        $g->commodity_object->current_balance = $current_balance;
        $g->commodity_object->currency = $currency;
        $g->commodity_object->price_point = $price_point;
        $g->commodity_object->time = $g->time;
        $g->commodity_object->comment = $comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $g->commodity_object->save();

        if ($result === false) {

            breakout(' Failed operation to save the commodity object. ');

        }


        /**
         * Report success.
         */

        $g->message .= " I've updated address <b>{$g->commodity_object->address}</b>'s record. ";


        /**
         * We want to reassure the user that the commodity record has been saved.
         * So, we are going to hook into the "See Commodities" feature.
         */

        redirect_to("/ax1/commodity_see_my_records_create_edit/page");

    }
}