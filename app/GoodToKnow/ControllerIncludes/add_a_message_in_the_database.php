<?php

use GoodToKnow\Models\Message;
use Michelf\MarkdownExtra;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

global $user_id;

require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

$markdown = standard_form_field_prep('markdown', 1, 1500);

$html = MarkdownExtra::defaultTransform($markdown);

//$parsedown_object = new \ParsedownExtra();
//$parsedown_object->setMarkupEscaped(true);
//$parsedown_object->setSafeMode(true);
//$html = $parsedown_object->text($markdown);

$message_array = ['user_id' => $user_id, 'created' => time(), 'content' => $html];

$message_object = Message::array_to_object($message_array);

$db = get_db();

$result = $message_object->save($db, $sessionMessage);

if (!$result) {

    breakout(' Unexpected I was unable to save the new message. ');

}