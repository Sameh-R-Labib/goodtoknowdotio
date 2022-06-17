<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\bank_account_observer;
use GoodToKnow\Models\banking_acct_for_balances;
use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class annul_a_banking_acct_for_balances_delete
{
    function page(string $answer = 'no')
    {
        /**
         * Here we will Read $answer which is the choice of whether
         * to delete the banking_acct_for_balances record. If 'yes' then
         * delete it. On the other hand if 'no' then reset
         * some session variables and redirect to the home page.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        /**
         * Stop if the banking_acct_for_balances identified by
         * id = saved_int01 has any associated bank_account_observer.
         */

        $sql = 'SELECT * FROM `bank_account_observer` WHERE `owner_id` = "' . $g->db->real_escape_string((string)$g->user_id) . '"';
        $sql .= ' AND `account_id` = "' . $g->db->real_escape_string((string)$g->saved_int01) . '"';

        $found_object = bank_account_observer::find_by_sql($sql);

        if ($found_object) {

            breakout(' Error: First you must delete all the bank account observers for this bank account 🚷. ');

        }


        $g->answer = $answer;


        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_parameter_validation.php';


        yes_no_parameter_validation();


        /**
         * Do nothing if user changed mind.
         */

        if ($g->answer == "no") {

            breakout(' Message: 85258525 Nothing was deleted. ');

        }


        /**
         * Delete the record.
         */

        $g->object = banking_acct_for_balances::find_by_id($g->saved_int01);

        if (!$g->object) {

            breakout(' I was not able to find the record so I aborted. ');

        }

        $result = $g->object->delete();

        if (!$result) {

            breakout(' Error: 41234432 Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        breakout(' I <b>deleted</b> the banking account. ');
    }
}