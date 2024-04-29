# PHP Product controller

### Nastavení

V souboru AppConfiguration jsou definovány constanty pro přepinání databáze a cache servisy. Nastavení složky pro ukládání souborů od statistiky a cache.

### Použité balíčky

Pro základní file cache jsem využil CacheInterface z balíčku psr/simple-cache.

    "psr/simple-cache": "^3.0",
    "symfony/cache": "^7.0"

### Změna Cache a DB

V nastavení zvolíme, kterou servisu bude Cache a DB využívat. Například pro DB je to `ElasticSearchDatabaseService` nebo `MySQLDatabaseService`, pro Cache je to aktuálně pouze FileCache a to `FileSimpleCacheService` nebo Symfony `FileSymfonyCacheService`.

CacheFactory nebo DatabaseFactory tuto volbu zpracuje a vrátí požadovou classu dané servisy.

    $cache = new CacheFactory();
    $cacheService = $cache->getService();

    $db = new DatabaseFactory();
    $dbService = $db->getService();

`CacheFactory` nebo `DatabaseFactory` využívají `ClassFactory`.

### Změna ukládání statistických dat

Vytvoření nové servisy např. `CSVStatisticsService`, která by měla mít implementovanou `StatisticsServiceInterface`.

Tato změna není zahrnuta v nastavení a je potřeba nově vytvořenou servisu zpracovat v `ProductControlleru`.

    $statFactory = new StatisticsFactory(PlainTextStatisticsService::class);

Změníme `PlainTextStatisticsService::class` na nově vytvořenou servisu tedy `CSVStatisticsService::class`.