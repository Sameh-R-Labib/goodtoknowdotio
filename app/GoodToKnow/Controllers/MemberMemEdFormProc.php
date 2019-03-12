<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-12
 * Time: 19:07
 */

namespace GoodToKnow\Controllers;


class MemberMemEdFormProc
{
    public function page()
    {
        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$_POST: </p>\n<pre>";
        var_dump($_POST);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");
    }
}