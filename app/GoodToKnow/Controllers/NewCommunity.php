<?php


namespace GoodToKnow\Controllers;


class NewCommunity
{
    function page()
    {
        /**
         * This route will generate a form
         * where the admin can enter the
         * information needed to generate
         * a new community.
         *
         * What are the db fields for a community?
         *  - id int(10)
         *  - community_name varchar(200)
         *  - community_description varchar(230)
         */

        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Create a New Community';

        require VIEWS . DIRSEP . 'newcommunity.php';
    }
}