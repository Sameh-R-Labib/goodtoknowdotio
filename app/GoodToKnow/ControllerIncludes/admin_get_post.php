<?php

use GoodToKnow\Models\post;


global $g;


if (!is_int($g->id) or $g->id < 1) {

    breakout(' Error 59213: Post id is either not int or is negative int. ');

}


$g->post_object = post::find_by_id($g->id);

if (!$g->post_object) {

    breakout(' Error 0192992. ');

}