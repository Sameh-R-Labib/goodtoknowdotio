<?php

use GoodToKnow\Models\MessageToUser;


global $g;
global $db;


if ($g->messages_last_time === null) {

    if ($db == 'not connected') {

        $db = db_connect();

        if ($db === false) {

            $g->message .= " Failed to connect to the database. ";
            $_SESSION['message'] = $g->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }

    }

    $quantity = MessageToUser::user_message_quantity($g->user_id);

    if ($quantity === false) {

        $g->message .= " Failed to get quantity of messages. ";
        $_SESSION['message'] = $g->message;
        reset_feature_session_vars();
        redirect_to("/ax1/InfiniteLoopPrevent/page");

    }

    $g->message .= "<br><br>You have {$quantity} message(s).
    <img src=\"\mdollnaery.gif\" alt=\"Smiley face\" height=\"22px\"> ";

    $_SESSION['messages_last_quantity'] = $quantity;
    $_SESSION['messages_last_time'] = time();
} else {
    $time_since_last = time() - $g->messages_last_time;
    $time_since_last = $time_since_last / 60;

    if ($time_since_last > 17) {

        if ($db == 'not connected') {

            $db = db_connect();

            if ($db === false) {

                $g->message .= " Failed to connect to the database. ";
                $_SESSION['message'] = $g->message;
                reset_feature_session_vars();
                redirect_to("/ax1/InfiniteLoopPrevent/page");

            }

        }

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
            $_SESSION['messages_last_time'] = time();

        }

    }

}