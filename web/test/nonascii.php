<?php
$welcome = "This ⅔ is ÷ a string.";
$result = mb_detect_encoding($welcome, 'ASCII', true);
var_dump($result);