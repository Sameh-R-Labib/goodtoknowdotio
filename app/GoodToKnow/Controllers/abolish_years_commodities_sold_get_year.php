<?php

namespace GoodToKnow\Controllers;

use Exception;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class abolish_years_commodities_sold_get_year
{
    function page()
    {
        /**
         * 1) Validate the submitted tax_year.
         * 2) Delete the commodity_sold(s/plural) which have the specified tax_year.
         * 3) Give confirmation of deletion.
         */

        global $g;

        kick_out_nonadmins_or_if_there_is_error_msg();

        get_db();


        /**
         * 1) Validate the submitted tax_year.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $tax_year = integer_form_field_prep('tax_year', 1992, 65535);


        /**
         * 2) Delete the commodity_sold(s/plural) which have the specified tax_year.
         */

        $num_affected_rows = 0;

        $sql = 'DELETE FROM `commodities_sold` WHERE `tax_year` = ';
        $sql .= $g->db->real_escape_string($tax_year);

        try {

            $g->db->query($sql);

            $query_error = $g->db->error;

            if (!empty(trim($query_error))) {

                $message = ' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                breakout($message);

            }

            $num_affected_rows = $g->db->affected_rows;

        } catch (Exception $e) {

            $g->message .= ' abolish_years_commodities_sold_get_year page() exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

        }

        if (!empty($g->message)) {

            breakout('');

        }


        /**
         * 3) Give confirmation of deletion.
         */

        $message = " The purge of Commodities Sold Records for the year <b>$tax_year</b> has resulted in deletion of <b>";
        $message .= $num_affected_rows . "</b> records. ";

        breakout($message);
    }
}