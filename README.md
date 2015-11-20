# orbit books

##ANgularJS and Yii Framework

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

/protected/api/ - модуль API

###Frontend: (AngularJS 1.5 beta)

/js/app/ - файлы приложения

/partials/ - html шаблоны

## API

###Books

url: /api/books/list

url: /api/books/view/<:id>

url: /api/books/add

url: /api/books/edit/<:id>

url: /api/books/delete/<:id>

###Genres

url: /api/genres/list

url: /api/genres/view/<:id>

url: /api/genres/add

url: /api/genres/edit/<:id>

url: /api/genres/delete/<:id>

<:id> - id записи в БД
