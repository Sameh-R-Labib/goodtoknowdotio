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

    $g->message .= "<br>You have $quantity message(s).
    <img src=\"\mdollnaery.gif\" alt=\"Smiley face\" height=\"22px\"> ";

    $_SESSION['messages_last_quantity'] = $quantity;
    $_SESSION['when_last_checked_messages'] = time();

} else {

    $time_since_last = time() - $g->when_last_checked_messages;
    $time_since_last = $time_since_last / 60;

    if ($time_since_last > 5) {

        db_connect_if_not_connected();

        $quantity = MessageToUser::user_message_quantity($g->user_id);

        if ($quantity === false) {

            $g->message .= " Failed to get quantity of messages. ";
            $_SESSION['message'] = $g->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }

        $quantity_new = $quantity - $g->messages_last_quantity;

        if ($quantity > $g->messages_last_quantity) {

            $g->message .= "<br><br>You have {$quantity} message(s). {$quantity_new} message(s) is/are new.
            <img src=\"\mdollnaery.gif\" alt=\"Smiley face\" height=\"22px\"> ";

            $_SESSION['messages_last_quantity'] = $quantity;

        }

        $_SESSION['when_last_checked_messages'] = time();

    }

}