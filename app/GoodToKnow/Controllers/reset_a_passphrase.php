<?php

namespace GoodToKnow\Controllers;

class reset_a_passphrase
{
    function page()
    {
        /**
         * This feature enables admin to set a new passphrase for the user.
         *
         * Q: Why would admin do such a thing?
         * A: Because the user forgot his passphrase.
         */


        kick_out_nonadmins_or_if_there_is_error_msg();
    }
}