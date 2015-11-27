# orbit books

##ANgularJS and Yii Framework

##DB
Дамп базы: /scheme/orbit_books.sql

## CONFIG
###Файлы настройки:
/protected/config/main.php

/protected/config/routes.php

/protected/config/db.php

## Файлы приложения
###Backend: (Yii Framework 1.6)

/protected/components/ - компоненты

/protected/controllers/ - индекс контроллер

/protected/config/ - файлы конфигурации

/protected/modules/api/ - модуль API

###Frontend: (AngularJS 1.5 beta)

/js/app/ - файлы приложения

/js/app/views/ - html шаблоны

## API

###Books

Список книг

GET /api/books/

Получить запись <id>

GET /api/books/<:id>

Добавить запись

POST /api/books/

Редактировать запись <id>

PUT /api/books/<:id>

Удалить запись

DELETE /api/books/delete/<:id>

###Genres

GET /api/genres/

<:id> - id записи в БД
