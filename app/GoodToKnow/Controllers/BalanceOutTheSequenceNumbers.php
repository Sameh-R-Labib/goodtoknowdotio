<?php


namespace GoodToKnow\Controllers;


class BalanceOutTheSequenceNumbers
{
    function page()
    {
        global $sessionMessage;

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbers.php';
    }
}