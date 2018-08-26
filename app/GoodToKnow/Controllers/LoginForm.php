<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/26/18
 * Time: 9:12 AM
 */

namespace GoodToKnow\Controllers;


class LoginForm
{
    public function page()
    {
        $html_title = 'LoginForm';

        require VIEWS . DIRSEP . 'loginform.php';
    }
}