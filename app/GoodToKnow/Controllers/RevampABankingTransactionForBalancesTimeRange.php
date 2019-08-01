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
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Validate the submitted choice of time range (A,B,C,D,E.)
         */
        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : '';
        if (empty($choice)) {
            $sessionMessage .= " You didn't choose so I've aborted the process for you. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $values = ['A', 'B', 'C', 'D', 'E'];
        if (!in_array($choice, $values)) {
            $sessionMessage .= " You choice is invalid. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Calculate the min and max times of the requested range.
         */
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
                $sessionMessage .= " Unexpectedly the switch statement failed. ";
                $_SESSION['message'] = $sessionMessage;
                redirect_to("/ax1/Home/page");
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