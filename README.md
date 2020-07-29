## Config
DB-Connection anpassen ```\mezzio\config\autoload\development.local.php.dist```

##Domain
http://doctrine-example.local/
http://doctrine-example.local:8080/ - adminer

## Install
0. Config anpassen
1. docker-compose up -d
2. DB erstellen
3. docker exec -it doctrineexample_php_1 bash
4. composer install

## Datenbank

DB-Schema liegt unter ```\mezzio\migrations\database.sql```

## Routen
Alle mögliche Routen kann man in dem Config finden:
```mezzio\src\Contact\ConfigProvider.php```

## Tests
Im container phpunit ausführen
