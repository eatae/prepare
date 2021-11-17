#### php-nginx
#### php-fpm
#### php-cli
#### PostgreSQL
#### RabbitMQ

* При использовании ENTRYPOINT как из Dockerfile, так и из docker-compose останавливается контейнер. Поэтому выполняем команду:
```
docker exec -it prepare-cli composer require php-amqplib/php-amqplib
```

* В docker-compose.yml для сервиса rabbitmq указываем hostname чтобы сервис видел уже созданные очереди и сообщения после перезапуска контейнера.


* Install PHPUnit
```
docker exec -it prepare-php-cli composer require --dev phpunit/phpunit
```

* Run Tests
```
docker exec -it prepare-php-cli vendor/bin/phpunit tests
```