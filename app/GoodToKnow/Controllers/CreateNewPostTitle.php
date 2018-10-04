<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/4/18
 * Time: 5:07 PM
 */

namespace GoodToKnow\Controllers;


class CreateNewPostTitle
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $saved_int02;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        echo "<p>The sequence number for the new post will be {$saved_int02}</p>";
    }
}