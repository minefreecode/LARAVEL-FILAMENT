<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ViewArticleController extends Controller
{
    public function __invoke(Article $article)
    {
        //Добавляет в проект теги для SEO
        seo()
            ->title("{$article->title} by {$article->author->name}") //Имя статьи и автор
            ->image('https://previewlinks.io/generate/templates/1055/meta?url=' . url()->current())//Картинка
            ->tag('previewlinks:overline', 'Filament')
            ->tag('previewlinks:title', $article->title)
            ->tag('previewlinks:subtitle', "By {$article->author->name}")
            ->tag('previewlinks:image', 'https://filamentphp.com/images/icon.png')
            ->tag('previewlinks:repository', 'filament/filament')
            ->withUrl()
            ->url($article->canonical_url ?? request()->url());

        return view('articles.view-article', ['article' => $article]);
    }
}
