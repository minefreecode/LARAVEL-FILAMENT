<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\PluginController;
use Illuminate\Support\Facades\Route;
//Получить плагины постранично
Route::get('plugins', [PluginController::class, 'index']);
//Показать плагин. Показ по идентификатору `slug`
Route::get('plugins/{plugin:slug}', [PluginController::class, 'show']);

//Получить авторов
Route::get('authors', [AuthorController::class, 'index']);
//Показать автора
Route::get('authors/{author:slug}', [AuthorController::class, 'show']);
//Получить артикли
Route::get('articles', [ArticleController::class, 'index']);
//Показать артикли
Route::get('articles/{article:slug}', [ArticleController::class, 'show']);
