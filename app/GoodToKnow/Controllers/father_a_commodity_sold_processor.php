<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity_sold;

class father_a_commodity_sold_processor
{
    function page()
    {
        /**
         * Create a database record in the commodities_sold table using the submitted commodities_sold data.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require CONTROLLERINCLUDES . DIRSEP . 'get_submitted_commodity_sold.php';


        /**
         * Redirect to give the user one chance to fix their time entry.
         * The correct time entries (both of them) for a commodity_sold record
         * would be in the past.
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

            if ($g->time_bought > time() or $g->time_sold > time()) {

                /**
                 * Reset 'is_first_attempt' in the session.
                 *
                 * We are setting 'is_first_attempt' to false so that once the user submits the form,
                 * and it is being processed it will not be retested for anomalous time entries.
                 */

                $_SESSION['is_first_attempt'] = false;


                // Put form data in an array to prepare it to be stored in $_SESSION['saved_arr01'].
                $saved_arr01['price_bought'] = $g->price_bought;
                $saved_arr01['price_sold'] = $g->price_sold;
                $saved_arr01['currency_transacted'] = $g->currency_transacted;
                $saved_arr01['commodity_amount'] = $g->commodity_amount;
                $saved_arr01['commodity_type'] = $g->commodity_type;
                $saved_arr01['commodity_label'] = $g->commodity_label;
                $saved_arr01['tax_year'] = $g->tax_year;
                $saved_arr01['profit'] = $g->profit;
                $saved_arr01['time_bought_date'] = $g->time_bought_date;
                $saved_arr01['time_bought_hour'] = $g->time_bought_hour;
                $saved_arr01['time_bought_minute'] = $g->time_bought_minute;
                $saved_arr01['time_bought_second'] = $g->time_bought_second;
                $saved_arr01['time_sold_date'] = $g->time_sold_date;
                $saved_arr01['time_sold_hour'] = $g->time_sold_hour;
                $saved_arr01['time_sold_minute'] = $g->time_sold_minute;
                $saved_arr01['time_sold_second'] = $g->time_sold_second;
                $saved_arr01['timezone'] = $g->timezone; // this is the actual timezone the user had entered


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/father_a_commodity_sold_redo/page");

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
         * Start formulating the commodity_sold object, so we can save it.
         */

        $array = ['user_id' => $g->user_id, 'time_bought' => $g->time_bought, 'time_sold' => $g->time_sold,
            'price_bought' => $g->price_bought, 'price_sold' => $g->price_sold, 'currency_transacted' => $g->currency_transacted,
            'commodity_amount' => $g->commodity_amount, 'commodity_type' => $g->commodity_type,
            'commodity_label' => $g->commodity_label, 'tax_year' => $g->tax_year, 'profit' => $g->profit];

        $object = commodity_sold::array_to_object($array);

        get_db();

        $result = $object->save();

        if (!$result) {

            breakout(' The save method for commodity_sold returned false. ');

        }

        if (!empty($g->message)) {

            breakout(' The save method for commodity_sold did not return false but it did send
            back a message. Therefore, it probably did not create the commodity_sold record. ');

        }


        /**
         * Wrap it up.
         */

        $g->message .= ' Your new Capital Gain has just been created 👍🏿 ';


        /**
         * We want to reassure the user that the commodity sold record has been saved.
         * So, we are going to hook into the "See a Year's Capital Gain Records" feature.
         */

        redirect_to("/ax1/spy_commodities_sold_create_edit/page");

    }
}