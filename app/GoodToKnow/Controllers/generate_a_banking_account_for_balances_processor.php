<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class generate_a_banking_account_for_balances_processor
{
    function page()
    {
        /**
         * Create a database record in the banking_acct_for_balances table using the submitted banking_acct_for_balances
         * data.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $acct_name = standard_form_field_prep('acct_name', 3, 30);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        $start_balance = float_form_field_prep('start_balance', -99999999999999.99, 99999999999999.99);

        $currency = standard_form_field_prep('currency', 1, 15);

        $comment = standard_form_field_prep('comment', 0, 1800);


        /**
         * Redirect to give the user one chance to fix their time entry.
         * A correct time entry for a Bank Account record would be in the past.
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
                $saved_arr01['acct_name'] = $acct_name;
                $saved_arr01['start_balance'] = $start_balance;
                $saved_arr01['currency'] = $currency;
                $saved_arr01['comment'] = $comment;
                $saved_arr01['date'] = $g->date;
                $saved_arr01['hour'] = $g->hour;
                $saved_arr01['minute'] = $g->minute;
                $saved_arr01['second'] = $g->second;
                $saved_arr01['timezone'] = $g->timezone; // this is the actual timezone the user had entered


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/generate_a_banking_account_for_balances_redo/page");

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
         * Create a banking_acct_for_balances array for the record.
         */

        $array_record = ['user_id' => $g->user_id, 'acct_name' => $acct_name, 'start_time' => $g->time,
            'start_balance' => $start_balance, 'currency' => $currency, 'comment' => $comment];


        /**
         * Make the array into an in memory banking_acct_for_balances object for the record.
         */

        $object = banking_acct_for_balances::array_to_object($array_record);


        /**
         * Save the object.
         */

        get_db();

        $result = $object->save();

        if (!$result) {

            breakout(' Your save for bank account failed 😟 ');

        }

        if (!empty($g->message)) {

            breakout(' Your save for bank account did not fail but it did send back a message.
             Therefore, it probably did not create the bank account 😟 ');

        }


        /**
         * Wrap it up.
         */

        $g->message .= ' Your new bank account has just been created 👍🏽 ';


        /**
         * We want to reassure the user that the banking account has been saved.
         * So, we are going to hook into the "Bank Accounts And Their Starting Balances" feature.
         */

        redirect_to("/ax1/view_all_banking_accounts_for_balances/page");
    }
}