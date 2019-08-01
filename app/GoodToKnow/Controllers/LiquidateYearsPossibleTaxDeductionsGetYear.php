<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class LiquidateYearsPossibleTaxDeductionsGetYear
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Delete the possible_tax_deduction which have the specified year_paid.
         * 3) Give confirmation of deletion.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         *  1) Validate the submitted year_paid.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_paid = integer_form_field_prep('year_paid', 1992, 65535);

        if (is_null($year_paid)) {
            $sessionMessage .= " Your year_paid did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Delete the possible_tax_deduction which have the specified year_paid.
         */
        $num_affected_rows = 0;
        $sql = 'DELETE FROM `possible_tax_deduction` WHERE `year_paid` = ';
        $sql .= $db->real_escape_string($year_paid);

        try {
            $db->query($sql);
            $query_error = $db->error;
            if (!empty(trim($query_error))) {
                $sessionMessage .= ' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';
                $_SESSION['message'] = $sessionMessage;
                redirect_to("/ax1/Home/page");
            }
            $num_affected_rows = $db->affected_rows;
        } catch (\Exception $e) {
            $sessionMessage .= ' LiquidateYearsPossibleTaxDeductionsGetYear page() exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        }

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Give confirmation of deletion.
         */
        $sessionMessage .= " The purge of PossibleTaxDeductions for the year <b>{$year_paid}</b> has deleted <b>";
        $sessionMessage .= $num_affected_rows . "</b> records. ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}