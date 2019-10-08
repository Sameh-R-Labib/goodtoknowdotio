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

        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<p>Var_dump \$diff_time: </p>\n<pre>";
        var_dump($diff_time);
        echo "</pre>\n";
        echo "<p>Var_dump \$showtime: </p>\n<pre>";
        var_dump($showtime);
        echo "</pre>\n";
        echo "<p>Var_dump time(): </p>\n<pre>";
        var_dump(time());
        echo "</pre>\n";
        echo "<p>Var_dump abs($diff_time): </p>\n<pre>";
        var_dump(abs($diff_time));
        echo "</pre>\n";
        die("<p>At least we got this far.</p>\n");

        return $label;

    }


    /**
     * If $diff_time is negative show the brown dragon. Otherwise, show the green dragon.
     */

    if ($diff_time < 0) {

        $label .= ' <img src="\brown_drag.gif" alt="brown dragon gif">';

    } else {

        $label .= ' <img src="\green_drag.gif" alt="green dragon gif">';

    }

    return $label;
}