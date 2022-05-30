<?php

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once 'app.php';

use telegrambot\Bot\TelegramBotClass;

$newBot = new TelegramBotClass($_ENV['BOT_TOKEN']);

$botUpdates = $newBot->getUpdates();

//get last botUpdate
$botUpdate = end($botUpdates);


$newBot->setChatId($botUpdates->message->chat->id);
$newBot->setChatType($botUpdates->message->chat->type);
$newBot->setChatUsername($botUpdates->message->chat->username);
$newBot->setChatFirstName($botUpdates->message->chat->first_name);

$newBot->setWebhook();

$newBot->checkMessaje($botUpdates->message->text);

$newBot->deleteWebhook();

?>
