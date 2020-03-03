# Parser

## Описание
Парсер постов с rbc.ru.

![](demo.gif)

## Установка
```
docker-compose up -d --build
```

### API
```
docker exec -it parser_builder sh
cd app
composer install
php artisan queue:work
```

Добавить 127.0.0.1 parser.local в hosts

### Front
```
docker exec -it parser_builder sh
cd front
npm run serve
```

Будет доступен на localhost:8080
