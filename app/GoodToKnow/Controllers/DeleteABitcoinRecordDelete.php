<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;

class DeleteABitcoinRecordDelete
{
    function page()
    {
        /**
         * Here we will read the choice of whether or not to delete the bitcoin record. If yes then delete it.
         * On the other hand if no then reset some session variables and redirect to the home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;

        kick_out_loggedoutusers();

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

        $db = get_db();

        $bitcoin = Bitcoin::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$bitcoin) {
            breakout(' I was NOT able to find the bitcoin record and I\'ve aborted. ');
        }

        $result = $bitcoin->delete($db, $sessionMessage);

        if (!$result) {
            breakout(' Unexpectedly I could not delete the bitcoin record. ');
        }


        // Report successful deletion of post.

        breakout(' I have deleted the ₿ record. ');
    }
}