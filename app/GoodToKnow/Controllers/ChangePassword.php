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


        global $app_state;


        kick_out_loggedoutusers();


        $app_state->html_title = 'Change Password';


        require VIEWS . DIRSEP . 'changepassword.php';
    }
}