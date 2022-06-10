<?php

namespace GoodToKnow\Controllers;

class c_p_purges
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->page = 'c_p_purges';


        $g->show_poof = true;


        $g->html_title = 'System Maintenance';


        $g->message .= " This is Gtk.io's System Maintenance. ";


        require VIEWS . DIRSEP . 'cppurges.php';
    }
}