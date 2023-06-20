<?php

namespace GoodToKnow\Controllers;

class cover_page
{
    function page()
    {
        /**
         * The cover_page is almost the same as the home page.
         * The main difference is that the cover_page does not
         * present blog community, topic or post.
         *
         * Just like the home page the cover_page will be
         * frequently the target of redirection and will
         * present messages and alerts. Also, it will enforce
         * user suspensions and system offline conditions.
         */


        home::redirect_if_not_logged_in();


        home::logout_the_user_if_he_is_suspended();
    }
}