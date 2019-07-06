<?php


namespace GoodToKnow\Controllers;


class RevampABankingAccountForBalancesTimeRange
{
    public function page()
    {
        /**
         * 1) Validate the submitted choice of time range (A,B,C,D,E.)
         * 2) Calculate the min and mac times of the requested rang.
         * 3) Store the min and max in session variables.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}