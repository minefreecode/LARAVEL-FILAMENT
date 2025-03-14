<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PackageGitHubStarsStats
{
    public function __invoke(string $repository = 'filamentphp/filament')
    {
        //Выдаем количество звёзд на GitHub либо каждый день обращаемся к IP за информацией
        return cache()->remember(
            "package:{$repository}:github_stars_count",
            now()->addDay(),
            function () use ($repository): int {
                $response = Http::get("https://api.github.com/repos/{$repository}");

                return $response->json('stargazers_count') ?? 0;
            },
        );
    }
}
