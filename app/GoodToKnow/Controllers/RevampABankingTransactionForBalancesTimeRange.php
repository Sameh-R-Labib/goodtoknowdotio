<?php

namespace GoodToKnow\Controllers;

class RevampABankingTransactionForBalancesTimeRange
{
    function page()
    {
        /**
         * 1) Validate the submitted choice of time range (A,B,C,D,E.)
         * 2) Calculate the min and max times of the requested range.
         * 3) Store the min and max in session variables.
         * 4) Redirect.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         * 1) Validate the submitted choice of time range (A,B,C,D,E.)
         */

        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : '';

        if (empty($choice)) {
            breakout(' You didn\'t choose. ');
        }

        $values = ['A', 'B', 'C', 'D', 'E'];

        if (!in_array($choice, $values)) {
            breakout(' You choice is invalid. ');
        }


        /**
         * 2) Calculate the min and max times of the requested range.
         */

        $min = 0;
        $max = 0;

        switch ($choice) {
            case 'A':
                // Last 30 days
                $min = time() - 2592000;
                $max = time();
                break;
            case 'B':
                // 30 - 60 day range
                $min = time() - 5184000;
                $max = time() - 2592000;
                break;
            case 'C':
                // 60 - 90 day range
                $min = time() - 7776000;
                $max = time() - 5184000;
                break;
            case 'D':
                // Beyond 90 days
                $min = 1483259485;
                $max = time() - 7776000;
                break;
            case 'E':
                // All
                $min = 1483259485;
                $max = time();
                break;
            default:
                breakout(' Unexpectedly the switch statement failed. ');
        }


        /**
         * 3) Store the min and max in session variables.
         */

        $_SESSION['saved_int01'] = $min;

        $_SESSION['saved_int02'] = $max;


        /**
         * Redirect
         */

        redirect_to("/ax1/RevampABankingTransactionForBalancesChooseRecord/page");
    }
}