<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/27/18
 * Time: 10:01 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;


class AdminPassCodeGenerationForm
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;


        /**
         * Debug code
         */
        echo "\n\n<p>You are in Admin Passcode Generation Form code base.</p>\n\n";
        echo "\n\n<p>A var dump of \$is_logged_in gives: </p>\n\n";
        var_dump($is_logged_in);
        echo "\n\n<p>A var dump of \$is_admin gives: </p>\n\n";
        var_dump($is_admin);
        echo "\n\n<p>A var dump of \$sessionMessage gives: </p>\n\n";
        var_dump($sessionMessage);
//        die("\n\n<p>Die statement.</p>\n\n");



        if (!$is_logged_in OR !$is_admin) {
            die("\n\n<p>Somehow this condition was true</p>\n\n");
            $sessionMessage .= ' You need to be the Admin to follow that request route.';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Debug Code
         */
        die("\n\n<p>So that condition was not true.</p>\n\n");

        /**
         * Here we need to have an enumerated array
         * of community objects. We will use this array
         * in the view template to generate each radio
         * input field. Each object has:
         *   - community_id
         *   - community_name
         *   - community_description
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1");
        }

        // Community::find_all() should return the array we are looking for (see above)
        $all_communities = Community::find_all($db, $sessionMessage);

        /**
         * Debug Code
         */
        var_dump($all_communities);
        die("\n\n<p>My die statement executed here.</p>\n\n");

        $html_title = 'Admin Pass-Code Generation Form';

        require VIEWS . DIRSEP . 'adminpasscodegenerationform.php';
    }
}