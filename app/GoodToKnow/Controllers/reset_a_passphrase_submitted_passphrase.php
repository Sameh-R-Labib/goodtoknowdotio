<?php

namespace GoodToKnow\Controllers;

class reset_a_passphrase_submitted_passphrase
{
    function page()
    {
        /**
         * We have saved_str_01. Which is the username.
         * We have first_try and password. Which give us the passphrase admin entered.
         *
         * Here, we need to make sure the password is valid.
         * If it is then update the database.
         * If it is NOT then redirect to the route which presents the form for entering the password
         * so that admin can try again.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();
    }
}