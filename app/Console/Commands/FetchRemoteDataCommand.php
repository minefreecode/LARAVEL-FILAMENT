<?php

namespace App\Console\Commands;

use App\Actions\FetchPluginDataFromAnystack;
use Illuminate\Console\Command;

class FetchRemoteDataCommand extends Command
{
    protected $signature = 'fetch-remote-data';

    protected $description = 'Fetch optional data from APIs';

    /**
     * Получить данные из Anystack
     * @param FetchPluginDataFromAnystack $fetchPluginDataFromAnystack Подключаем сервис к команде
     * @return int
     */
    public function handle(
        FetchPluginDataFromAnystack $fetchPluginDataFromAnystack,
    ): int {
        $fetchPluginDataFromAnystack();

        return 0;
    }
}
