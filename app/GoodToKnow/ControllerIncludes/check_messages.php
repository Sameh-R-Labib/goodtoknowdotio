<?php

use GoodToKnow\Models\message_to_user;


global $g;


if ($g->when_last_checked_messages === null) {

    db_connect_if_not_connected();

    $quantity = message_to_user::user_message_quantity($g->user_id);

    if ($quantity === false) {

        breakout(" Failed to get quantity of messages. ");

    }

    $g->messages_button = " <a class=\"blackbtn\" href=\"/ax1/inbox/page\">🎫&nbsp;&nbsp;$quantity 🔴</a> ";

    $_SESSION['messages_last_quantity'] = $quantity;
    $_SESSION['when_last_checked_messages'] = time();

} else {

    $time_since_last = time() - $g->when_last_checked_messages;
    $time_since_last = (int)$time_since_last / 60;

    if ($time_since_last > 2) {

        db_connect_if_not_connected();

        $quantity = message_to_user::user_message_quantity($g->user_id);

        if ($quantity === false) {

            breakout(" Failed to get quantity of messages. ");

        }

        $quantity_new = (int)$quantity - (int)$g->messages_last_quantity;

        if ($quantity > $g->messages_last_quantity) {

            $g->messages_button = " <a class=\"blackbtn\" href=\"/ax1/inbox/page\">🎫&nbsp;&nbsp;$quantity 🔴&nbsp;&nbsp;$quantity_new new</a> ";

        } else {

            $g->messages_button = " <a class=\"blackbtn\" href=\"/ax1/inbox/page\">🎫&nbsp;&nbsp;$quantity</a> ";

        }

        $_SESSION['messages_last_quantity'] = $quantity;
        $_SESSION['when_last_checked_messages'] = time();

    } else {

        // Just have the quantity per the session stored value

        $quantity = $_SESSION['messages_last_quantity'];

        $g->messages_button = " <a class=\"blackbtn\" href=\"/ax1/inbox/page\">🎫&nbsp;&nbsp;$quantity</a> ";

    }

}
