<?php

namespace GoodToKnow\Controllers;

class FatherACommoditySoldRedo
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Tell the user he is seeing the form a 2nd time.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time values because we think they are wrong.</b> ';


        $g->html_title = 'One chance to redo';


        require VIEWS . DIRSEP . 'fatheracommoditysold.php';
    }
}