<?php

namespace App\Actions;

use App\Models\Plugin;
use Illuminate\Support\Facades\Http;
use Throwable;

use function Filament\Support\format_money;

/**
 * Вызывется из команды получения данных из Anystack
 * Это сервис лицензирования
 */
class FetchPluginDataFromAnystack
{
    public function __invoke(): void
    {
        //Делается объект запроса с токеном
        $anystack = Http::withToken(config('services.anystack.token'));

        try {
            //Получает данные каналов с anystack в виде json
            $advertismentChannels = $anystack
                ->get('https://api.anystack.sh/v1/affiliate-beta')
                ->json()['data'] ?? [];

            /**
             * collect создает коллекцию из массива
             * keyBy - добавляет записям ключи 'id'
             * ['da7855a9-36a1-44a4-87b9-8e5852ae08d2']  - выбирает элемент коллекции по данному ключу
             */
            $advertisementChannel = collect($advertismentChannels)->keyBy('id')['da7855a9-36a1-44a4-87b9-8e5852ae08d2'] ?? null;

            //Если каналы не получены ничего не обрабатываем
            if (! $advertisementChannel) {
                return;
            }

            // Для полученного канала получаем продукты по ключу `products`
            $advertisedProducts = collect($advertisementChannel['products'] ?? [])->keyBy('id');

            Plugin::query()
                ->inRandomOrder()
                ->whereNotNull('anystack_id')
                ->get()
                ->each(function (Plugin $plugin) use ($advertisedProducts): void {
                    if (! $advertisedProducts->has($plugin->anystack_id)) {
                        cache()->forget($plugin->getCheckoutUrlCacheKey());
                        cache()->forget($plugin->getPriceCacheKey());

                        return;
                    }

                    $advertisedProducts = $advertisedProducts->get($plugin->anystack_id);

                    $checkoutUrl = $advertisedProducts['checkout_url'];

                    if (blank($checkoutUrl)) {
                        return;
                    }

                    cache()->put($plugin->getCheckoutUrlCacheKey(), $checkoutUrl);

                    echo "Caching checkout URL for plugin {$plugin->getKey()} - {$checkoutUrl}. \n";

                    $prices = collect($advertisedProducts['prices'] ?? []);

                    if ($prices->isEmpty()) {
                        return;
                    }

                    $priceAmount = $prices->min('amount');
                    $priceCurrency = $prices->keyBy('amount')[$priceAmount]['currency'];

                    if (blank($priceAmount)) {
                        return;
                    }

                    if (blank($priceCurrency)) {
                        return;
                    }

                    $price = format_money($priceAmount, $priceCurrency, divideBy: 100);

                    cache()->put($plugin->getPriceCacheKey(), $price);

                    echo "Caching price for plugin {$plugin->getKey()} - {$price}. \n";
                });
        } catch (Throwable $exception) {
            echo "Failed to fetch any data from Anystack: {$exception->getMessage()}";

            // 👹
        }
    }
}
