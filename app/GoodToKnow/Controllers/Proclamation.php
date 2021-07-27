<?php

namespace GoodToKnow\Controllers;

class Proclamation
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'Proclamation';


        $g->show_poof = true;


        $g->html_title = 'Proclamation';


        $g->message .= ' What the proponents of the Gtk.io project believe in and pursue. ';


        require VIEWS . DIRSEP . 'proclamation.php';
    }
}