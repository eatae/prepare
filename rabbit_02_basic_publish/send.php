<?php
require_once realpath(__DIR__ .'/../config.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$exchangeName = 'test_ex';
$queueName = 'test_q';



$connection = new AMQPStreamConnection(
    RABBITMQ_HOST,
    RABBITMQ_PORT,
    RABBITMQ_USER,
    RABBITMQ_PASS
);

// получаем канал связи
$channel = $connection->channel();

// создаём очередь
$channel->queue_declare(
    $queueName,
    false,   // пассивный режим - false
    true,    // восстановление в случае падения
    false,  // очередь доступна из других каналов
    false // очередь не удаляется если этот канал закроется
);

// создаём обменник
$channel->exchange_declare(
    $exchangeName,
    'direct',
    true,
    false
);

// bind queue adn exchange
$channel->queue_bind($queueName, $exchangeName);

