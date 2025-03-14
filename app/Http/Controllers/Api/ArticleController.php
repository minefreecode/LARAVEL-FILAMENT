<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Получить артикли постранично
     * @return mixed
     */
    public function index()
    {
        return Article::paginate();
    }

    /**
     * Показать артикли
     *
     * @param Article $article
     * @return mixed
     */
    public function show(Article $article)
    {
        return $article->append('stars_count');
    }
}
