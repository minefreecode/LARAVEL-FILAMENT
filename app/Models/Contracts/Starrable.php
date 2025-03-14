<?php

namespace App\Models\Contracts;

use App\Models\Author;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Интерфейс для тех объектов которые имеют связи `Starrable` о том что у них могут быть звёзды
 */
interface Starrable
{
    /**
     * Обычная связь один ко многим
     * @return MorphMany
     */
    public function stars(): MorphMany;

    /**
     * Количество звёзд в кеше
     * @return void
     */
    public function cacheStarsCount(): void;

    /**
     * Получить автора
     * @return Author
     */
    public function getAuthor(): Author;
}
