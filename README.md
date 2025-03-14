# Описание проекта

В проекте используется [orbit](https://github.com/ryangjchandler/orbit) для того чтобы, к примеру данные модели `Plugin` хранить в файле в папке `content/plugins.

Имеются обработки массивов
```PHP
$advertisementChannel = collect($advertismentChannels)->keyBy('id')['da7855a9-36a1-44a4-87b9-8e5852ae08d2'] ?? null;
```

Для проекта сконфигурирован кэш ``memchache``. Там хранятся данные относящиеся к моделям. Все названия ключей в ``memcache`` делаются с префиксом названия модели и идентификатора модели, например `plugin:slug:`+ что за данные.

В проекте много мест с кешами привязанными к моделям. В кеше данные обновляются из БД каждый день
```PHP
        //если в кеше не существует будет вытаскивать из БД, а так будет брать из кеша
        return cache()->remember(
            $this->getStarsCountCacheKey(),//Имя кеша, сгенерированное методом
            now()->addDay(),//Хранит один день. То есть обновление кеша происходит каждый день
            fn (): int => $this->stars()->where(fn (Builder $query) => $query->whereNull('is_vpn_ip')->orWhere('is_vpn_ip', false))->count(),
        );
```




