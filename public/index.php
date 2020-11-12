<?php
declare(strict_types=1);

use Dsantang\DiceRoller\DI;
use Dsantang\DiceRoller\DiceRoller;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '/vendor/autoload.php';

$DI = new DI();

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new DiceRoller($DI->buildContainer())
        )
    ),
    8081
);

$server->run();