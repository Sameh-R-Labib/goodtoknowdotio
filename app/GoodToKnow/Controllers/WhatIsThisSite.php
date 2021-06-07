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


        global $g;


        /**
         * Present the view.
         */

        $g->is_guest = true;

        $g->html_title = 'What is this site?';

        $g->page = 'About';

        $g->show_poof = true;

        $g->message = " Read and decide if you'd like to use this. ";

        require VIEWS . DIRSEP . 'whatisthissite.php';
    }
}