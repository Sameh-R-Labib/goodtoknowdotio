<?php

namespace GoodToKnow\Controllers;

class WhatIsThisSite
{
    function page()
    {
        /**
         * This function will present a page which informs the people
         * from the Internet who land on the login page by chance and
         * don't have an idea what this site is for.
         */


        global $app_state;
        global $show_poof;


        /**
         * Present the view.
         */

        $app_state->is_guest = true;

        $app_state->html_title = 'What is this site?';

        $app_state->page = 'About';

        $show_poof = true;

        $app_state->message = " Read and decide if you'd like to use this. ";

        require VIEWS . DIRSEP . 'whatisthissite.php';
    }
}