<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class CleanupYearsTaxableIncomeEventsGetYear
{
    function page()
    {
        /**
         * 1) Validate the submitted year_received.
         * 2) Delete the taxable_income_event(s/plural) which have the specified year_received.
         * 3) Give confirmation of deletion.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        /**
         * 1) Validate the submitted year_received.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_received = integer_form_field_prep('year_received', 1992, 65535);

        if (is_null($year_received)) {
            breakout(' Year received did NOT pass validation. ');
        }


        /**
         * 2) Delete the taxable_income_event(s/plural) which have the specified year_received.
         */

        $num_affected_rows = 0;

        $sql = 'DELETE FROM `taxable_income_event` WHERE `year_received` = ';
        $sql .= $db->real_escape_string($year_received);

        try {
            $db->query($sql);

            $query_error = $db->error;

            if (!empty(trim($query_error))) {
                $message = ' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                breakout($message);
            }

            $num_affected_rows = $db->affected_rows;
        } catch (\Exception $e) {
            $sessionMessage .= ' CleanupYearsTaxableIncomeEventsGetYear page() exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        }

        if (!empty($sessionMessage)) {
            breakout('');
        }


        /**
         * 3) Give confirmation of deletion.
         */

        $message = " The purge of Taxable Income Events for the year <b>{$year_received}</b> has deleted <b>";
        $message .= $num_affected_rows . "</b> records. ";

        breakout($message);
    }
}