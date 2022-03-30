<?php

namespace GoodToKnow\Controllers;

use Exception;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class cleanup_years_taxable_income_events_get_year
{
    function page()
    {
        /**
         * 1) Validate the submitted year_received.
         * 2) Delete the taxable_income_event(s/plural) which have the specified year_received.
         * 3) Give confirmation of deletion.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();

        get_db();


        /**
         * 1) Validate the submitted year_received.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $g->tax_year = integer_form_field_prep('year_received', 1992, 65535);


        /**
         * 2) Delete the taxable_income_event(s/plural) which have the specified year_received.
         */

        $num_affected_rows = 0;

        $sql = 'DELETE FROM `taxable_income_event` WHERE `year_received` = ';
        $sql .= $g->db->real_escape_string($g->tax_year);

        try {

            $g->db->query($sql);

            $query_error = $g->db->error;

            if (!empty(trim($query_error))) {
                $message = ' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                breakout($message);
            }

            $num_affected_rows = $g->db->affected_rows;

        } catch (Exception $e) {

            $g->message .= ' cleanup_years_taxable_income_events_get_year page() exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

        }

        if (!empty($g->message)) {

            breakout('');

        }


        /**
         * 3) Give confirmation of deletion.
         */

        $message = " The purge of Taxable Income Events for the year <b>$g->tax_year</b> has resulted in deletion of <b>";
        $message .= $num_affected_rows . "</b> records. ";

        breakout($message);
    }
}