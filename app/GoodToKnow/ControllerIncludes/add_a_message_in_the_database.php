<?php

use GoodToKnow\Models\Message;
use Michelf\MarkdownExtra;
use function GoodToKnow\ControllerHelpers\markdown_form_field_prep;


global $db;
global $user_id;
global $message_object;


require_once CONTROLLERHELPERS . DIRSEP . 'markdown_form_field_prep.php';

$markdown = markdown_form_field_prep('markdown', 1, 1500);

$parser = new MarkdownExtra;
$parser->no_entities = true;
$html = $parser->transform($markdown);

// Call to global function
fix_michelf($html);

//$html = MarkdownExtra::defaultTransform($markdown);

//$parsedown_object = new \ParsedownExtra();
//$parsedown_object->setMarkupEscaped(true);
//$parsedown_object->setSafeMode(true);
//$html = $parsedown_object->text($markdown);

$message_array = ['user_id' => $user_id, 'created' => time(), 'content' => $html];

$message_object = Message::array_to_object($message_array);

$db = get_db();

$result = $message_object->save($db);

if (!$result) {

    breakout(' Unexpected I was unable to save the new message. ');

}