<?php

namespace GoodToKnow\Controllers;

class proclamation
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->page = 'proclamation';


        $g->show_poof = true;


        $g->html_title = 'proclamation';


        $g->message .= ' What the proponents of the Gtk.io project believe in and pursue. ';
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'proclamation.php';
    }
}