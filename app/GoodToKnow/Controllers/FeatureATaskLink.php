<?php

namespace GoodToKnow\Controllers;

class FeatureATaskLink
{
    function page(int $id)
    {
        /**
         * This function handles the request received when a user clicks on a link
         * on the Show Tasks page.
         *
         * This function is a modified version of FeatureATaskEdit. The difference is that
         * this function will get the id of the task from the request itself.
         */

        echo "The id is $id";
    }
}