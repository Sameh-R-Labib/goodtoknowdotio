<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-01-09
 * Time: 16:48
 */

namespace GoodToKnow\Controllers;


class GiveComsChoices
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $saved_str01;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$saved_str01: </p>\n<pre>";
        var_dump($saved_str01);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");
    }
}