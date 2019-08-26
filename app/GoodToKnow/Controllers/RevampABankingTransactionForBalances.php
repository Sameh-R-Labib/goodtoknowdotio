<?php

namespace GoodToKnow\Controllers;

class RevampABankingTransactionForBalances
{
    function page()
    {
        /**
         * This page is going to present some radio buttons for answering the question of which
         * time range the user wants to see further choices of transactions for.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $html_title = 'Which time range for filtering your transaction choices?';

        require VIEWS . DIRSEP . 'revampabankingtransactionforbalances.php';
    }
}