<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class AbolishYearsCommoditiesSoldGetYear
{
    function page()
    {
        /**
         * 1) Validate the submitted tax_year.
         * 2) Delete the CommoditySold(s/plural) which have the specified tax_year.
         * 3) Give confirmation of deletion.
         */

        global $sessionMessage;

        kick_out_nonadmins();

        $db = get_db();


        /**
         * 1) Validate the submitted tax_year.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $tax_year = integer_form_field_prep('tax_year', 1992, 65535);


        /**
         * 2) Delete the CommoditySold(s/plural) which have the specified tax_year.
         */

        $num_affected_rows = 0;

        $sql = 'DELETE FROM `commodities_sold` WHERE `tax_year` = ';
        $sql .= $db->real_escape_string($tax_year);

        try {
            $db->query($sql);

            $query_error = $db->error;

            if (!empty(trim($query_error))) {
                $message = ' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                breakout($message);
            }

            $num_affected_rows = $db->affected_rows;
        } catch (\Exception $e) {
            $sessionMessage .= ' AbolishYearsCommoditiesSoldGetYear page() exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        }

        if (!empty($sessionMessage)) {
            breakout('');
        }


        /**
         * 3) Give confirmation of deletion.
         */

        $message = " The purge of Commodities Sold Records for the year <b>{$tax_year}</b> has resulted in deletion of <b>";
        $message .= $num_affected_rows . "</b> records. ";

        breakout($message);
    }
}