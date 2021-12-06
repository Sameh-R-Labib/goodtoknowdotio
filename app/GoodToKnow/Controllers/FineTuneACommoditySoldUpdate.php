<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommoditySold;

class FineTuneACommoditySoldUpdate
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted finetuneacommoditysoldedit.php form data. (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require CONTROLLERINCLUDES . DIRSEP . 'get_submitted_commodity_sold.php';


        /**
         * Redirect to give the user one chance to fix their time entry.
         * The correct time entries (both of them) for a Commodity Sold record
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


                redirect_to("/ax1/FineTuneACommoditySoldRedo/page");

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

        $object = CommoditySold::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->time_bought = $g->time_bought;
        $object->time_sold = $g->time_sold;
        $object->price_bought = $g->price_bought;
        $object->price_sold = $g->price_sold;
        $object->currency_transacted = $g->currency_transacted;
        $object->commodity_amount = $g->commodity_amount;
        $object->commodity_type = $g->commodity_type;
        $object->commodity_label = $g->commodity_label;
        $object->tax_year = $g->tax_year;
        $object->profit = $g->profit;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save();

        if ($result === false) {

            breakout(' I failed at saving the updated object (most likely because you didn\'t make any changes to it.) ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated <b>{$object->commodity_label}</b>. ");
    }
}