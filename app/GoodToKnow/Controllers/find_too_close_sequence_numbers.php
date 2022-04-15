<?php

namespace GoodToKnow\Controllers;

class find_too_close_sequence_numbers
{
    function page()
    {
        /**
         * What This Feature Does
         * ======================
         *   - It tells Admin which communities have topics whose sequence numbers are too close to each other.
         *   - It tells Admin which Topics have posts whose sequence numbers are too close to each other.
         */

        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();
    }
}