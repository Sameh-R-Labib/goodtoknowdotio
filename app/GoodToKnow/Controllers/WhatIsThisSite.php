<?php


namespace GoodToKnow\Controllers;


class WhatIsThisSite
{
    public function page()
    {
        /**
         * This function will present a page
         * which informs the people from the Internet who
         * land on the login page by chance and don't
         * have an idea what this site is for.
         */

        $is_guest = true;

        $html_title = 'What is this site?';

        $page = 'About';

        $show_poof = true;

        $sessionMessage = " Welcome guest! See the information below and decide if you'd like to become a member. ";

        require VIEWS . DIRSEP . 'whatisthissite.php';
    }
}