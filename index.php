<?php

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once 'app.php';

use telegrambot\Bot\TelegramBotClass;

$newBot = new TelegramBotClass($_ENV['BOT_TOKEN']);

$botUpdates = $newBot->getUpdates();

dump($botUpdates);

$newBot->setChatId($botUpdates[0]->message->chat->id);
$newBot->setChatType($botUpdates[0]->message->chat->type);
$newBot->setChatUsername($botUpdates[0]->message->chat->username);
$newBot->setChatFirstName($botUpdates[0]->message->chat->first_name);

$newBot->setWebhook();

$newBot->checkMessaje($botUpdates[0]->message->text);

$newBot->deleteWebhook();

?>
