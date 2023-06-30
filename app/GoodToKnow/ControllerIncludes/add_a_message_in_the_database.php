<?php

use GoodToKnow\Models\message;
use Michelf\MarkdownExtra;
use function GoodToKnow\ControllerHelpers\markdown_form_field_prep;


global $g;


require_once CONTROLLERHELPERS . DIRSEP . 'markdown_form_field_prep.php';

$markdown = markdown_form_field_prep('markdown', 1, 1500);

$parser = new MarkdownExtra;
$parser->no_entities = true; // So, & stays as & instead of &amp;
$html = $parser->transform($markdown);

// Call to global function
fix_michelf($html);

//$html = MarkdownExtra::defaultTransform($markdown);

//$parsedown_object = new \ParsedownExtra();
//$parsedown_object->setMarkupEscaped(true);
//$parsedown_object->setSafeMode(true);
//$html = $parsedown_object->text($markdown);

$message_array = ['user_id' => $g->user_id, 'created' => time(), 'content' => $html];

$g->message_object = message::array_to_object($message_array);

$result = $g->message_object->save();

if (!$result) {

    breakout(' Unexpected I was unable to save the new message. ');

}