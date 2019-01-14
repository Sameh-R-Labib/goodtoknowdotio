<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-01-13
 * Time: 22:01
 */

namespace GoodToKnow\Controllers;


class GiveComsChoicesProcessor
{
    public function page()
    {
        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$: </p>\n<pre>";
        var_dump($_POST);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");
    }
}