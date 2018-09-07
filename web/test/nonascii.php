<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/7/18
 * Time: 2:23 PM
 */
$welcome = "This ⅔ is ÷ a string.";
$result = mb_detect_encoding($welcome, 'ASCII', true);
var_dump($result);