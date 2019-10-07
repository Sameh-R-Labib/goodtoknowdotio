<?php

namespace GoodToKnow\Controllers;

class BlotOutSomeInboxMessagesProcessor
{
    function page()
    {
        /**
         *
         */

        global $sessionMessage;

        global $user_id;

        kick_out_loggedoutusers();

        echo "<p>Var_dump \$_POST: </p>\n<pre>";
        var_dump($_POST);
        echo "</pre>\n";
    }
}