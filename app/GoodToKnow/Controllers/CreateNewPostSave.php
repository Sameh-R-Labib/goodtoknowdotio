<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/4/18
 * Time: 10:35 PM
 */

namespace GoodToKnow\Controllers;


class CreateNewPostSave
{
    public function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $user_id;
        global $saved_str01;                // The main title
        global $saved_str02;                // The title extension
        global $saved_int01;                // The topic id
        global $saved_int02;                // The sequence number

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Overview
         *   Mainly we are here to store the new post.
         *
         * So far we have:
         *   - $user_id
         *   - $saved_str01 (main title)
         *   - $saved_str02 (title extension)
         *   - $saved_int01 (topic id)
         *   - $saved_int02 (sequence number)
         */


    }
}