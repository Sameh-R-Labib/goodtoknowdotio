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


        global $gtk;
        global $show_poof;


        /**
         * Present the view.
         */

        $gtk->is_guest = true;

        $gtk->html_title = 'What is this site?';

        $gtk->page = 'About';

        $show_poof = true;

        $gtk->message = " Read and decide if you'd like to use this. ";

        require VIEWS . DIRSEP . 'whatisthissite.php';
    }
}