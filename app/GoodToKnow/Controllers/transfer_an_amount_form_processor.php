<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class transfer_an_amount_form_processor
{
    function page()
    {
        /**
         * Create two (2) database records in the banking_transaction_for_balances
         * table using the submitted data. One record will be for the account
         * sending the money and the other will be for the bank receiving the money.
         *
         * Also, there is a redo feature.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        $label = standard_form_field_prep('label', 3, 264);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        // $amount can only be positive.

        $amount = float_form_field_prep('amount', -0.0000000000000001, 99999999999999.99);


        $sending_account = integer_form_field_prep('sending_account', 1, PHP_INT_MAX);


        $receiving_account = integer_form_field_prep('receiving_account', 1, PHP_INT_MAX);


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

                // In transfer_an_amount_redo I will formulate the html
                // for the two drop-downs. And that's where I'll use
                // two values below to mark as selected the appropriate
                // bank account.
                $saved_arr01['receiving_account'] = (string)$receiving_account;
                $saved_arr01['sending_account'] = (string)$sending_account;


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/transfer_an_amount_redo/page");
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
         * Here's some of what we have:
         *  $label $g->time $amount $sending_account $receiving_account
         */


        /**
         * Update the account sending the money.
         */

        $deduction = $amount * -1.0;

        $array_record = ['user_id' => $g->user_id, 'bank_id' => $sending_account, 'label' => $label, 'amount' => $deduction,
            'time' => $g->time];

        $object = BankingTransactionForBalances::array_to_object($array_record);

        get_db();

        $result = $object->save();

        if (!$result) {

            breakout(' I was unable to save transaction #1. ');

        }

        if (!empty($g->message)) {

            breakout(' The #1 save method did not return false but it did send back a message. Therefore,
             it probably did not create the BankingTransactionForBalances record. ');

        }


        /**
         * Update the account sending the money.
         */

        $array_record = ['user_id' => $g->user_id, 'bank_id' => $receiving_account, 'label' => $label, 'amount' => $amount,
            'time' => $g->time];

        $object = BankingTransactionForBalances::array_to_object($array_record);

        $result = $object->save();

        if (!$result) {

            breakout(' I was unable to save transaction #2. ');

        }

        if (!empty($g->message)) {

            breakout(' The #2 save method did not return false but it did send back a message. Therefore,
             it probably did not create the BankingTransactionForBalances record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' Both transactions created 👍🏽 ');
    }
}