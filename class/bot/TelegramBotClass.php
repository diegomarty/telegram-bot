<?php

declare(strict_types=1);


namespace telegrambot\Bot;

use Exception;

class TelegramBotClass
{

    protected string $botToken;
    protected int $botId;
    protected string $botName;
    protected string $botUsername;
    protected int $chatId;
    protected string $chatType;
    protected string $chatUsername;
    protected string $chatFirstName;

    private const URL_API_TELEGRAM = 'https://api.telegram.org/bot';

    public function __construct(string $botToken)
    {
        $this->setBotToken($botToken);
        $this->obtenerDatosBot();
    }

    public function getBotToken(): string
    {
        return $this->botToken;
    }

    public function setBotToken(string $botToken): self
    {
        $this->botToken = $botToken;

        return $this;
    }

    public function getBotName(): string
    {
        return $this->botName;
    }

    public function setBotName(string $botName): self
    {
        $this->botName = $botName;

        return $this;
    }

    public function getBotId(): int
    {
        return $this->botId;
    }

    public function setBotId(int $botId): self
    {
        $this->botId = $botId;

        return $this;
    }

    public function getBotUsername(): string
    {
        return $this->botUsername;
    }

    public function setBotUsername(string $botUsername): self
    {
        $this->botUsername = $botUsername;

        return $this;
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }

    public function setChatId(int $chatId): self
    {
        $this->chatId = $chatId;

        return $this;
    }

    public function getChatType(): string
    {
        return $this->chatType;
    }

    public function setChatType(string $chatType): self
    {
        $this->chatType = $chatType;

        return $this;
    }

    public function getChatUsername(): string
    {
        return $this->chatUsername;
    }

    public function setChatUsername(string $chatUsername): self
    {
        $this->chatUsername = $chatUsername;

        return $this;
    }

    public function getChatFirstName(): string
    {
        return $this->chatFirstName;
    }

    public function setChatFirstName(string $chatFirstName): self
    {
        $this->chatFirstName = $chatFirstName;

        return $this;
    }

    private function obtenerDatosBot(): void
    {

        $url = self::URL_API_TELEGRAM . $this->getBotToken() . '/getMe';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($result, true);

        if (isset($result['ok']) && $result['ok'] == true) {
            $this->setBotName($result['result']['first_name']);
            $this->setBotId($result['result']['id']);
            $this->setBotUsername($result['result']['username']);
        } else {
            throw new Exception('[EXCEPTION] ' . $this::class . '::obtenerDatosBot() - No ha sido posible obtener los datos del bot' . $this::class . '. [ERROR]: ' . $result);
        }
    }

    public function getUpdates(): object
    {

        $url = self::URL_API_TELEGRAM . $this->getBotToken() . '/getUpdates';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($result, true);
        dd($result);
        if (isset($result['ok']) && $result['ok'] == true) {
            return $result['result'];
        } else {
            throw new Exception('[EXCEPTION] ' . $this::class . '::getUpdates() - No ha sido posible obtener las actualizaciones ' . $this::class . '. [ERROR]: ' . $result);
        }
    }

    public function sendMessage(int $chatId, string $text): bool
    {

        $url = self::URL_API_TELEGRAM . $this->getBotToken() . '/sendMessage';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'chat_id=' . $chatId . '&text=' . $text);

        $result = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($result, true);

        if (isset($result['ok']) && $result['ok'] == true) {
            return true;
        } else {
            return false;
        }
        throw new Exception('[EXCEPTION] ' . $this::class . '::sendMessage() - No ha sido posible enviar el mensaje ' . $this::class . '. [ERROR]: ' . $result);
    }

    public function setWebhook(): bool
    {
        $url = self::URL_API_TELEGRAM . $this->getBotToken() . '/setWebhook?url=' . $_ENV['WEBHOOK_URL'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($result, true);

        if (isset($result['ok']) && $result['ok'] == true) {
            echo 'Webhook creado correctamente';
            return true;
        } else {
            echo 'No se ha podido crear el webhook';
            return false;
        }
        throw new Exception('[EXCEPTION] ' . $this::class . '::setWebhook() - No ha sido posible establecer el webhook ' . $this::class . '. [ERROR]: ' . $result);
    }

    public function deleteWebhook(): void
    {
        $url = self::URL_API_TELEGRAM . $this->getBotToken() . '/deleteWebhook';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($result, true);

        if (isset($result['ok']) && $result['ok'] == true) {
            echo 'Webhook eliminado correctamente';
            dump($result);
        } else {
            throw new Exception('[EXCEPTION] ' . $this::class . '::deleteWebhook() - No ha sido posible eliminar el webhook ' . $this::class . '. [ERROR]: ' . $result);
        }
    }

    public function getWebhookInfo(): void
    {
        $url = self::URL_API_TELEGRAM . $this->getBotToken() . '/getWebhookInfo';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($result, true);

        if (isset($result['ok']) && $result['ok'] == true) {
            echo 'Webhook creado correctamente';
            dump($result);
        } else {
            throw new Exception('[EXCEPTION] ' . $this::class . '::setWebhook() - No ha sido posible obtener la informacion del webhook ' . $this::class . '. [ERROR]: ' . $result);
        }
    }

    public function checkMessaje(string $message): bool
    {
        switch ($message) {
            case '/start':
                $this->sendMensajeBienvenida();
                return true;
                break;
            case '/help':
                $this->sendMensajeAyuda();
                return true;
                break;
            case '/hora':
                $this->sendMensajeHora();
                return true;
                break;
            default:
                $this->sendMessage($this->getChatId(), 'No entiendo lo que me dices');
                return false;
                break;
        }
    }

    public function sendMensajeBienvenida(): void
    {
        $mensaje = 'Hola ' . $this->getChatFirstName() . '! Da la bienvenida al bot  ' . $this->getBotName() . '.';
        $this->sendMessage($this->getChatId(), $mensaje);
    }

    public function sendMensajeAyuda(): void
    {
        $mensaje =
            'Estos son los commandos disponibles:
                /start - Da la bienvenida al bot
                /help - Muestra esta ayuda
                /hora - Muestra la hora actual
            ';
        $this->sendMessage($this->getChatId(), 'Hola ' . $this->getBotName() . '!');
    }

    public function sendMensajeHora(): void
    {
        $mensaje = 'La hora actual es: ' . date('H:i:s');
        $this->sendMessage($this->getChatId(), $mensaje);
    }
}
