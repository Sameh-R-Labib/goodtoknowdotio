<?php

namespace GoodToKnow\Controllers;

class proclamation
{
    function page()
    {
        global $g;


        if (!empty($g->message)) {

            breakout(' Task aborted because an error message was generated. ');

        }


        $g->page = 'proclamation';


        $g->show_poof = true;


        $g->html_title = 'proclamation';


        $g->message .= ' What the proponents of the Gtk.io project believe in and pursue. ';
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'proclamation.php';
    }
}