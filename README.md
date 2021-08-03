# xCore для bitrix

## version 0.3.0 (beta)

## не совсместимо с версией xAPI 0.2.x

### не предназначено для практического применения!

## Пример установки

Получаем модуль из git:
```
mkdir bitrix/modules/x.core;  
cd bitrix/modules/x.core/;  
git clone https://github.com/Suntechnic/xCore .
или
git clone git@github.com:Suntechnic/xCore.git .
```

Переходим на https:/site.my/bitrix/admin/partner_modules.php?lang=ru и устанавливаем модуль.

Создаем конфигурационные файлы:
```
cd -;
mkdir local;
mkdir local/x;
cp bitrix/modules/x.core/x.exemple/config.php local/x/config.php;  
```

При отсуствии создаем /local/php_interface/init.php:
```
mkdir local/php_interface;
touch local/php_interface/init.php;  
```

Добавляем в /local/php_interface/init.php первой строкой:
```php
<?  
// подключение xCore  
// https://github.com/Suntechnic/xCore/blob/master/README.md  
\Bitrix\Main\Loader::includeModule('x.core');
```


## В файле /local/x/config.php можно переопределить ряд констант
(первоначально необходимо создать файл /local/x/config.php - пока его нет API не работает)
Разместите в нём следующий код возвращающий массив констант:  
```php
<?  
return array(  
        // окружение приложения  
        'APPLICATION_ENV' => 'dev',  
        // версия реализации  
        'APPLICATION_VERSION' => '0',  
        // файл версионирования  
        //'APPLICATION_VERSION_FILE' => '/.git/logs/HEAD',  
        // соль приложения  
        'XDEFINE_SALT' => 'salt',  
        'XDEFINE_CACHETIME' => 129600  
    );
```  

## Список констант

APPLICATION_ENV - состояне приложения - [dev|combo|production]. В состояниях dev и combo загружается отладчик  
  
### Константы путей

P_ - путь к родительскому каталогу xCore  
S_ - абсолютный путь к DOCUMENT_ROOT сервера  
  
P_X - каталог xCore  
P_INTERFACE - интерфейс AJAX и REST сервисов приложения  
P_LAYOUT - каталог шаблона шаблонов  
P_MEDIA - каталог со статичными файлами  
P_CSS - каталог стилей  
P_FONTS - каталог шрифтов  
P_JS - каталог скриптов  
P_IMAGES - каталог с изображениями (например бэкграунды и банеры)  
P_INCLUDES - каталог с другими подключаемыми файлами (svg и tmpl используся X\Helpers\Html)  
    P_SVG - каталог с svg (используется хелпером)  
    P_TMPL - каталог микрошаблонов (используется хелпером)  
    P_CONTENT - каталог содержащий контентные вставки
    
P_LOG - каталог логов xCore  
P_SOURCESDUMP - каталог со "свалкой" ресурсов  


Большинство констант имеют копии вида S_константа - указывающие абсолютный путь:  
S_P_X  
S_P_INTERFACE  
S_P_LAYOUT  
S_P_CSS  
S_P_FONTS  
S_P_JS  
S_P_IMAGES  
S_P_INCLUDES  
S_P_LOG  
S_P_SOURCESDUMP  
S_P_SVG  
S_P_TMPL  
S_P_CONTENT  

### Другие внутренние константы  
XDEFINE_VERSION - версия xCore  
XDEFINE_SALT - соль  
XDEFINE_CACHETIME - время внутренних кэшей в секундах. По умолчанию 36800 в режиме production, 8 в режиме dev и 90 во всех иных случаях
  
Кроме того автоматически объявляются проектозависимые константы:  
IDIB_{символьныйКодИнфоблока} - id инфоблока
