<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @param string $label
 * @param $showtime
 * @return string
 */
function get_proximity_task_label(string $label, $showtime): string
{
    $showtime = (int)$showtime;

    $diff_time = $showtime - time();


    /**
     * If the absolute value of $diff_time is greater than 8 days then do nothing and return $label.
     */

    if (abs($diff_time) > 691200) {

        return $label;

    }


    /**
     * If $diff_time is negative show the brown dragon. Otherwise, show the green dragon.
     */

    if ($diff_time < 0) {

        $label .= '&nbsp;&nbsp;&nbsp;<img class="in-paragraph" src="/img/brown_drag.gif" alt="brown dragon" height="63px">';

    } else {

        $label .= '&nbsp;&nbsp;&nbsp;<img class="in-paragraph" src="/img/green_drag.gif" alt="green dragon" height="67px">';

    }

    return $label;
}