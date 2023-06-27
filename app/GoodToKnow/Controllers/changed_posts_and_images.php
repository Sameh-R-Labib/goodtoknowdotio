<?php

namespace GoodToKnow\Controllers;

class changed_posts_and_images
{
    function page()
    {
        /**
         * This is a feature which helps admin monitor uploaded images and changed posts.
         */


        kick_out_nonadmins();


        require VIEWS . DIRSEP . 'changedpostsandimages.php';
    }
}