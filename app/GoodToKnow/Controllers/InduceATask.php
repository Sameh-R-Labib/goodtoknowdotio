<?php

namespace GoodToKnow\Controllers;

class InduceATask
{
    function page()
    {
        /**
         * Create a task record based on a label for it.
         */


        global $gtk;


        kick_out_loggedoutusers();


        $gtk->html_title = 'Create a New Task';


        require VIEWS . DIRSEP . 'induceatask.php';
    }
}