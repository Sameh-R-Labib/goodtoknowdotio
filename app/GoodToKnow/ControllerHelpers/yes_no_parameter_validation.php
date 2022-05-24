<?php

namespace GoodToKnow\ControllerHelpers;


/**
 * @return void
 */
function yes_no_parameter_validation()
{
    /**
     * This function validates $g->answer. $g->answer is supposed to be either
     * 'yes' or 'no' string. $g->answer comes from a page() parameter.
     *
     * If $g->answer is invalid then this function causes a breakout.
     */


    global $g;

    if ($g->answer != "yes" && $g->answer != "no") {

        breakout(' Error: 31323536 You did not enter a yes/no choice. ');

    }
}