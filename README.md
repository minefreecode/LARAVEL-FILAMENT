# Описание проекта

В проекте используется [orbit](https://github.com/ryangjchandler/orbit) для того чтобы, к примеру данные модели `Plugin` хранить в файле в папке `content/plugins.

Имеются обработки массивов
```PHP
$advertisementChannel = collect($advertismentChannels)->keyBy('id')['da7855a9-36a1-44a4-87b9-8e5852ae08d2'] ?? null;
```

Для проекта сконфигурирован кэш ``memchache``. Там хранятся данные относящиеся к моделям. Все названия ключей в ``memcache`` делаются с префиксом названия модели и идентификатора модели, например `plugin:slug:`+ что за данные.



