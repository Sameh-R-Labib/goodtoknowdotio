<?php

namespace GoodToKnow\Controllers;

class reset_a_passphrase_enter_a_passphrase
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();
    }
}