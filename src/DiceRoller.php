<?php
declare(strict_types=1);

namespace Dsantang\DiceRoller;

use Dsantang\DiceRoller\Dices\Fair;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

final class DiceRoller implements MessageComponentInterface
{
    /**
     * @var SplObjectStorage
     */
    private $clients;

    private Router $router;

    public function __construct(Router $router) {
        $this->clients = new SplObjectStorage;
        $this->router  = $router;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);

        echo 'New connection: ({$conn->resourceId})' . PHP_EOL;
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo sprintf(
            'Client %d sending message "%s" to %d other client%s' . PHP_EOL,
            $from->resourceId,
            $msg,
            count($this->clients) - 1,
            (count($this->clients) - 1) == 1 ? '' : 's'
        );

        $response = $this->router->route($msg);

        foreach ($this->clients as $client) {
            if ($from === $client) {
                $client->send(sprintf('You rolled: %s', $response));
            } else {
                $client->send(sprintf('Client "%d" rolled: %s', $from->resourceId, $response)
                );
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

        echo 'Connection {$conn->resourceId} has disconnected' . PHP_EOL;
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
        echo 'An error has occurred: {$e->getMessage()}';

        $conn->close();
    }
}