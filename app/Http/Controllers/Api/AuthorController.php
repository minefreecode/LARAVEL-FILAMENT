<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Получить авторов постранично
     *
     * @return mixed
     */
    public function index()
    {
        return Author::paginate();
    }

    /**
     * Показать автора постранично
     *
     * @param Author $author
     * @return mixed
     */
    public function show(Author $author)
    {
        return $author->append('stars_count');
    }
}
