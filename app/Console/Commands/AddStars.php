<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Contracts\Starrable;
use App\Models\Plugin;
use Illuminate\Console\Command;

class AddStars extends Command
{
    /**
     * Сигнатура вызова команды
     * @var string
     */
    protected $signature = 'add-stars {starrable} {number}';

    /**
     * Описание
     * @var string
     */
    protected $description = 'Adds stars to a starrable model';

    public function handle(): int
    {
        /**
         * Получить плагины с заданныи  аргументами команды
         * @var ?Starrable $starrable
         */
        $starrable = Plugin::find($this->argument('starrable')) ?? Article::find($this->argument('starrable'));

        //Валидация  на присутствие полученных данных
        if (! $starrable) {
            $this->error('Starrable model not found');

            return Command::FAILURE;//Возвращаем сообщение об ошибке
        }

        //Создаем связные данные
        $starrable->stars()->createMany(
            array_fill(0, $this->argument('number'), [
                'ip' => 0,
            ])
        );

        $starrable->cacheStarsCount();

        return Command::SUCCESS;
    }
}
