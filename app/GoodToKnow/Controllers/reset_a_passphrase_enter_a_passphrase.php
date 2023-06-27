<?php

namespace GoodToKnow\Controllers;

class reset_a_passphrase_enter_a_passphrase
{
    function page()
    {
        /**
         * saved_str01 has the username.
         *
         * Here we present a form for entering what admin wants the
         * user's new passphrase to be.
         */


        global $g;


        kick_out_nonadmins();


        $g->html_title = "Reset A User's Passphrase";


        require VIEWS . DIRSEP . 'resetapassphraseenterapassphrase.php';
    }
}