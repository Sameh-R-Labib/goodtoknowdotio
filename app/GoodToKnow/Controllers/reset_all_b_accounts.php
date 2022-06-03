<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\reset_bank_account;

class reset_all_b_accounts
{
    function page()
    {
        /**
         * When the user runs this feature he ends up with bank account
         * records whose start dates are not more than 38 days old.
         */

        /**
         * In this route I will iterate over the user's bank accounts.
         * For each iteration I will call a function which resets the
         * bank account I'm iterating over.
         */

        /**
         * We need the bank accounts.
         */


        global $g;


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        // $g->array_of_objects is what I got.


        /**
         * Reset the accounts.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'reset_bank_account.php';

        foreach ($g->array_of_objects as $account) {

            /**
             * Debug Code
             */
            echo "\n<p>Begin debug</p>\n";
            echo "<p>Var_dump \$account: </p>\n<pre>";
            var_dump($account);
            echo "</pre>\n";
            die("<p>End debug</p>\n");

            // Call the function which resets an account on $account.
            reset_bank_account($account);

        }
    }
}