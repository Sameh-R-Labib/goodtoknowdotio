<?php

use GoodToKnow\Models\MessageToUser;


global $g;


if ($g->when_last_checked_messages === null) {

    db_connect_if_not_connected();

    $quantity = MessageToUser::user_message_quantity($g->user_id);

    if ($quantity === false) {

        $g->message .= " Failed to get quantity of messages. ";
        $_SESSION['message'] = $g->message;
        reset_feature_session_vars();
        redirect_to("/ax1/InfiniteLoopPrevent/page");

    }

    $g->messages_button = " <a class=\"blackbtn\" href=\"/ax1/Inbox/page\">🎫 $quantity 🔴</a> ";

    $_SESSION['messages_last_quantity'] = $quantity;
    $_SESSION['when_last_checked_messages'] = time();

} else {

    $time_since_last = time() - $g->when_last_checked_messages;
    $time_since_last = (int)$time_since_last / 60;

    if ($time_since_last > 2) {

        db_connect_if_not_connected();

        $quantity = MessageToUser::user_message_quantity($g->user_id);

        if ($quantity === false) {

            $g->message .= " Failed to get quantity of messages. ";
            $_SESSION['message'] = $g->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }

        $quantity_new = (int)$quantity - (int)$g->messages_last_quantity;

        if ($quantity > $g->messages_last_quantity) {

            $g->messages_button = " <a class=\"blackbtn\" href=\"/ax1/Inbox/page\">🎫 $quantity 🔴 $quantity_new new</a> ";

        }

        $_SESSION['messages_last_quantity'] = $quantity;
        $_SESSION['when_last_checked_messages'] = time();

    } else {

        // Just have the quantity per the session stored value

        $quantity = $_SESSION['messages_last_quantity'];

        $g->messages_button = " <a class=\"blackbtn\" href=\"/ax1/Inbox/page\">🎫 $quantity</a> ";

    }

}


$g->message .= $g->messages_button;
