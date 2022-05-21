<?php
require_once realpath(__DIR__ .'/../config.php');
require_once realpath(__DIR__ .'/../vendor/autoload.php');

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
    false,   // если укажем true, то не создаётся exchange и падаем с ошибкой если такого нет
    false
);

// bind queue adn exchange
$channel->queue_bind($queueName, $exchangeName);


$toSend = new AMQPMessage(
    'Test message',
    ['content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
);

// publish msg
$channel->basic_publish($toSend, $exchangeName);

// get msg
$message = $channel->basic_get($queueName);
$channel->basic_ack($message->delivery_info['delivery_tag']);
var_dump($message->body);

// close connection
$channel->close();
$connection->close();