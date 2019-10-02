<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class NukeATaxableIncomeEventConfirmation
{
    function page()
    {
        /**
         * Here we will read the choice of whether or not to delete the record. If yes then
         * delete it. On the other hand if no then reset some session variables and redirect to the home page.
         */

        global $sessionMessage;
        global $saved_int01;

        kick_out_loggedoutusers();


        /**
         * Do nothing if user changed mind.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_form_field_prep.php';

        $choice = yes_no_form_field_prep('choice');

        if ($choice == "no") {

            breakout(' Nothing was deleted. ');

        }


        /**
         * Delete the record.
         */

        $db = get_db();

        $object = TaxableIncomeEvent::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {

            breakout(' I was not able to find the record. ');

        }

        $result = $object->delete($db, $sessionMessage);

        if (!$result) {

            breakout(' Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        breakout(' I deleted the Taxable 💸 Event 📽. ');
    }
}