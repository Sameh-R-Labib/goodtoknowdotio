<?php

namespace GoodToKnow\Controllers;

class ChangePassword
{
    function page()
    {
        /**
         * We will display a form where the user enters their current password and the
         * new password. The new password must be entered twice.
         */


        global $g;


        kick_out_loggedoutusers();


        $g->html_title = 'Change Password';


        require VIEWS . DIRSEP . 'changepassword.php';
    }
}