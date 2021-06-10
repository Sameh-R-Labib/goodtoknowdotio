<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class AnnulABankingAcctForBalancesDelete
{
    function page()
    {
        /**
         * Here we will Read the choice of whether
         * or not to delete the banking_acct_for_balances record. If 'yes' then
         * delete it. On the other hand if 'no' then reset
         * some session variables and redirect to the home page.
         */


        global $g;


        kick_out_loggedoutusers();


        /**
         * Do nothing if user changed mind.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_form_field_prep.php';

        $choice = yes_no_form_field_prep('choice');

        if ($choice == "no") {

            breakout(' Nothing was deleted. ');

        }


        /**
         * Delete the record.
         */

        $g->db = get_db();

        $g->object = BankingAcctForBalances::find_by_id($g->saved_int01);

        if (!$g->object) {

            breakout(' I was not able to find the record so I have aborted. ');

        }

        $result = $g->object->delete();

        if (!$result) {

            breakout(' Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        breakout(' I deleted the 🏦ing 📒 for ⚖️s. ');
    }
}