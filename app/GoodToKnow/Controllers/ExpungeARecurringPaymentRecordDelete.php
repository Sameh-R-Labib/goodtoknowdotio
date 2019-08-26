<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;

class ExpungeARecurringPaymentRecordDelete
{
    function page()
    {
        /**
         * Here we will read the choice of whether or not to delete the recurring_payment record. If yes then
         * delete it. On the other hand if no then reset some session variables and redirect to the home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;

        kick_out_loggedoutusers();

        kick_out_onabort();

        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : "";

        if ($choice != "yes" && $choice != "no") {
            breakout(' You didn\'t enter a choice. ');
        }

        if ($choice == "no") {
            breakout(' Nothing was deleted. ');
        }

        $db = get_db();

        $object = RecurringPayment::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {
            breakout(' I was NOT able to find the recurring payment. ');
        }

        $result = $object->delete($db, $sessionMessage);

        if (!$result) {
            breakout(' Unexpectedly I could not delete the recurring payment record. ');
        }


        // Report successful deletion of post.

        breakout(' I have deleted the 🌀 💳 📽. ');
    }
}