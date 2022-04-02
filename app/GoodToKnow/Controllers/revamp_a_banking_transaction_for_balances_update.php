<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class revamp_a_banking_transaction_for_balances_update
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */


        global $g;
        // $g->saved_int01 record id


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * 1) Validate the submitted form data.
         *      (and apply htmlspecialchars)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        $label = standard_form_field_prep('label', 3, 264);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        $amount = float_form_field_prep('amount', -99999999999999.99, 99999999999999.99);


        $bank_id = integer_form_field_prep('bank_id', 1, PHP_INT_MAX);


        /**
         * This is the section of code where we redirect to a redo route
         * if the time which the user submitted is anomalous.
         *
         * Q: What condition would make $g->time anomalous?
         * A: If $g->time is in the future then that would be anomalous.
         *
         * Also, as you see in the code there is a mechanism which causes what we are
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
                $saved_arr01['label'] = $label;
                $saved_arr01['amount'] = $amount;
                $saved_arr01['date'] = $g->date;
                $saved_arr01['hour'] = $g->hour;
                $saved_arr01['minute'] = $g->minute;
                $saved_arr01['second'] = $g->second;
                $saved_arr01['timezone'] = $g->timezone;
                $saved_arr01['bank_id'] = $bank_id; // determines which choice from drop down is selected.


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/revamp_a_banking_transaction_for_balances_redo/page");
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

        $object = BankingTransactionForBalances::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->bank_id = $bank_id;
        $object->label = $label;
        $object->amount = $amount;
        $object->time = $g->time;


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

        /*breakout(" I've updated the <b>{$object->label}</b> record. ");*/


        /**
         * We want to reassure the user that the transaction has been saved.
         * So, we are going to hook into the "See Transactions" feature.
         */

        // I'm aware I'm re-using saved_int01 for something other than what this feature had been using it for.
        $_SESSION['saved_int01'] = $bank_id;

        redirect_to("/ax1/check_my_banking_account_tx_balances_show_balances/page");
    }
}