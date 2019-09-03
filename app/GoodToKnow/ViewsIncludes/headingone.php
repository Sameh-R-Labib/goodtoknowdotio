<?php

switch ($type_of_resource_requested) {
    case 'community':
        echo 'Topics';
        break;
    case 'topic':
        echo 'Posts';
        break;
    case 'post':
        echo 'Post Content';
        break;
    default:
        echo 'Information';
}