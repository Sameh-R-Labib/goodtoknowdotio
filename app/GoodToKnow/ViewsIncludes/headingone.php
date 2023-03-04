<?php

global $g;

switch ($g->type_of_resource_requested) {
    case 'community':
        echo '<h1>Topics</h1>';
        break;
    case 'topic':
        /*echo '<h1>Posts</h1>';*/
        break;
    case 'post':
        break;
    default:
        echo '<h1>Information</h1>';
}