<?php

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once 'app.php';

use telegrambot\Bot\TelegramBotClass;

$newBot = new TelegramBotClass($_ENV['BOT_TOKEN']);

var_dump($newBot);

?>
