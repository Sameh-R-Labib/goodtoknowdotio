<?php

use GoodToKnow\Models\MessageToUser;


global $gtk;
global $db;


if ($gtk->messages_last_time === null) {

    if ($db == 'not connected') {

        $db = db_connect();

        if ($db === false) {

            $gtk->message .= " Failed to connect to the database. ";
            $_SESSION['message'] = $gtk->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }

    }

    $quantity = MessageToUser::user_message_quantity($gtk->user_id);

    if ($quantity === false) {

        $gtk->message .= " Failed to get quantity of messages. ";
        $_SESSION['message'] = $gtk->message;
        reset_feature_session_vars();
        redirect_to("/ax1/InfiniteLoopPrevent/page");

    }

    $gtk->message .= "<br><br>You have {$quantity} message(s).
    <img src=\"\mdollnaery.gif\" alt=\"Smiley face\" height=\"22px\"> ";

    $_SESSION['messages_last_quantity'] = $quantity;
    $_SESSION['messages_last_time'] = time();
} else {
    $time_since_last = time() - $gtk->messages_last_time;
    $time_since_last = $time_since_last / 60;

    if ($time_since_last > 17) {

        if ($db == 'not connected') {

            $db = db_connect();

            if ($db === false) {

                $gtk->message .= " Failed to connect to the database. ";
                $_SESSION['message'] = $gtk->message;
                reset_feature_session_vars();
                redirect_to("/ax1/InfiniteLoopPrevent/page");

            }

        }

        $quantity = MessageToUser::user_message_quantity($gtk->user_id);

        if ($quantity === false) {

            $gtk->message .= " Failed to get quantity of messages. ";
            $_SESSION['message'] = $gtk->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }

        $quantity_new = $quantity - $gtk->messages_last_quantity;

        if ($quantity > $gtk->messages_last_quantity) {

            $gtk->message .= "<br><br>You have {$quantity} message(s). {$quantity_new} message(s) is/are new.
            <img src=\"\mdollnaery.gif\" alt=\"Smiley face\" height=\"22px\"> ";

            $_SESSION['messages_last_quantity'] = $quantity;
            $_SESSION['messages_last_time'] = time();

        }

    }

}