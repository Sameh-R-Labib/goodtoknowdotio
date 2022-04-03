<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity;
use function GoodToKnow\ControllerHelpers\commodity_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class initialize_a_commodity_record_processor
{
    function page()
    {
        /**
         * Create a database record in the commodity table using the submitted data.
         *
         */


        global $g;

        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'commodity_address_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $address = commodity_address_form_field_prep('address');

        $initial_balance = float_form_field_prep('initial_balance', -0.0000000000000001, 99999999999999.99);

        $current_balance = float_form_field_prep('current_balance', -0.0000000000000001, 99999999999999.99);

        $commodity = standard_form_field_prep('commodity', 1, 15);

        $currency = standard_form_field_prep('currency', 1, 15);

        $price_point = float_form_field_prep('price_point', -0.0000000000000001, 99999999999999.99);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


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


                redirect_to("/ax1/initialize_a_commodity_record_redo/page");

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
         * Create a commodity array for the record.
         */

        $array_commodity_record = ['user_id' => $g->user_id, 'address' => $address, 'commodity' => $commodity,
            'initial_balance' => $initial_balance, 'current_balance' => $current_balance, 'currency' => $currency,
            'price_point' => $price_point, 'time' => $g->time, 'comment' => $comment];


        /**
         * Make the array into an in memory commodity object for the record.
         */

        $commodity_object = commodity::array_to_object($array_commodity_record);


        /**
         * Save the object.
         */

        get_db();

        $result = $commodity_object->save();

        if (!$result) {

            breakout(' The save method for commodity returned false. ');

        }

        if (!empty($g->message)) {

            breakout(' The save method for commodity did not return false but it did send back a message.
             Therefore, it probably did not create the commodity record. ');

        }


        /**
         * Wrap it up.
         */

        /*breakout(' A new commodity record was created 👏. ');*/
        reset_feature_session_vars();


        /**
         * We want to reassure the user that the commodity record has been saved.
         * So, we are going to hook into the "See Commodities" feature.
         */

        redirect_to("/ax1/commodity_see_my_records_specify/page");

    }
}