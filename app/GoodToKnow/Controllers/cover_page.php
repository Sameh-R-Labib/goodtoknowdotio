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


        global $g;


        home::redirect_if_not_logged_in();


        home::logout_the_user_if_he_is_suspended();


        // This creates html button for inbox messages.
        require CONTROLLERINCLUDES . DIRSEP . 'check_messages.php';


        // There is a area in the view for showing $g->the_buttons.
        // Currently, for this route, there is only one button (the $g->messages_button.)
        $g->the_buttons .= $g->messages_button;


        home::add_alert_to_message();


        $g->show_poof = true;


        $g->html_title = 'Cover Page';


        $g->page = "cover_page";


        $g->message .= " 🎶 ";


        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'coverpage.php';

    }
}