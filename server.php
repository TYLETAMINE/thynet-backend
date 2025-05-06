<?php
require 'vendor/autoload.php'; // Подключаем автозагрузчик Composer
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
class Chat implements MessageComponentInterface {
    protected $clients;
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }
    public function onOpen(ConnectionInterface $conn) {
        // Храним соединение
        $this->clients->attach($conn);
        echo "Новое соединение! ({$conn->resourceId})\n";
    }
    public function onMessage(ConnectionInterface $from, $msg) {
        // Рассылаем сообщение всем клиентам, кроме отправителя
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }
    public function onClose(ConnectionInterface $conn) {
        // Удаляем соединение
        $this->clients->detach($conn);
        echo "Соединение {$conn->resourceId} отключено\n";
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Произошла ошибка: {$e->getMessage()}\n";
        $conn->close();
    }
}
// Создаем сервер и запускаем его
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    443
);
$server->run();