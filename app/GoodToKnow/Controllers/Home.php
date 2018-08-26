<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/22/18
 * Time: 9:09 PM
 */

namespace GoodToKnow\Controllers;


class Home
{
    public function page()
    {
        $html_title = 'GoodToKnow.io';

        require TOP;

        require VIEWS . DIRSEP . 'homepage.php';

        require BOTTOM;
    }
}