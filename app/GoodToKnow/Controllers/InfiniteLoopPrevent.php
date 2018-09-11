<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/11/18
 * Time: 12:37 PM
 */

namespace GoodToKnow\Controllers;


class InfiniteLoopPrevent
{
    public function page()
    {

        global $sessionMessage;

        $html_title = 'For Infinite Loop Prevention';

        require VIEWS . DIRSEP . 'infiniteloopprevent.php';
    }
}