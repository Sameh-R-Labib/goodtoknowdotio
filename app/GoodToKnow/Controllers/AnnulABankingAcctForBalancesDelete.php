<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;

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

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;

        kick_out_loggedoutusers();

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }

        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : "";

        if ($choice != "yes" && $choice != "no") {
            breakout(' You didn\'t enter a choice. ');
        }

        if ($choice == "no") {
            breakout(' Nothing was deleted. ');
        }

        $db = get_db();

        $object = BankingAcctForBalances::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {
            breakout(' I was not able to find the record so I have aborted. ');
        }

        $result = $object->delete($db, $sessionMessage);

        if (!$result) {
            breakout(' Unexpectedly I could not delete the record. ');
        }


        // Report successful deletion of post.

        breakout(' I deleted the 🏦ing 📒 for ⚖️s. ');
    }
}