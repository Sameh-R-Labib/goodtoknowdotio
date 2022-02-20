<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\readable_amount_no_commas;

class WriteOverATaxableIncomeEventEdit
{
    function page()
    {
        /**
         * 1) Store the submitted taxable_income_event id in the session.
         * 2) Retrieve the taxable_income_event object with that id from the database.
         * 3) Make sure the object belongs to the user.
         * 4) Present a form which is populated with data from the taxable_income_event object.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->html_title = 'Edit the taxable income event\'s record';


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_taxableincomeevent.php';


        /**
         * 4) Present a form which is populated with data from the taxable_income_event object.
         */


        /**
         * Make it so that if amount is fiat then amount has only two decimal places.
         */

        require CONTROLLERHELPERS . DIRSEP . 'readable_amount_no_commas.php';

        $g->object->amount = readable_amount_no_commas($g->object->currency, $g->object->amount);


        /**
         * Make it so that if price is fiat then amount has only two decimal places.
         */

        $g->object->price = readable_amount_no_commas($g->object->fiat, $g->object->price);


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead, we derive an array called $g->time from it and use $g->time to pre-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $g->time = get_date_h_m_s_from_a_timestamp($g->object->time);


        /**
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['label'] = $g->object->label;
        $g->saved_arr01['year_received'] = $g->object->year_received;
        $g->saved_arr01['currency'] = $g->object->currency;
        $g->saved_arr01['amount'] = $g->object->amount;
        $g->saved_arr01['price'] = $g->object->price;
        $g->saved_arr01['fiat'] = $g->object->fiat;
        $g->saved_arr01['comment'] = $g->object->comment;
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


        /**
         * Present the view.
         */

        $g->action = '/ax1/WriteOverATaxableIncomeEventUpdate/page';
        $g->heading_one = 'Edit a Taxable Income Event';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'taxable_income_event_form.php';
    }
}