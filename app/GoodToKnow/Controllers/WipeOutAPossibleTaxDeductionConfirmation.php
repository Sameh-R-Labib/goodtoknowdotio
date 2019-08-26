<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\PossibleTaxDeduction;

class WipeOutAPossibleTaxDeductionConfirmation
{
    function page()
    {
        /**
         * Here we will read the choice of whether
         * or not to delete the record. If yes then
         * delete it. On the other hand if no then reset
         * some session variables and redirect to the home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

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

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

        $object = PossibleTaxDeduction::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {
            breakout(' I was not able to find the record. ');
        }

        $result = $object->delete($db, $sessionMessage);

        if (!$result) {
            breakout(' Unexpectedly I could not delete the record. ');
        }


        // Report successful deletion of post.

        breakout(' I have deleted the 🤔 Tax ✍🏽🔽. ');
    }
}