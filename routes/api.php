<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('articles','App\Http\Controllers\Api\ArticleController');
Route::apiResource('posts','App\Http\Controllers\Api\PostController');

Route::namespace('App\Http\Controllers\Api')->prefix('articles/query')->group(function () {
    //CRUD練習
    Route::get('querySelect','ArticleController@querySelect');
    Route::get('querySpecific','ArticleController@querySpecific');
    Route::get('queryPagination','ArticleController@queryPagination');
    Route::get('queryRange/{min}/{max}','ArticleController@queryRange');
    Route::get('queryByCgy/{cgy}','ArticleController@queryByCgy');
    Route::get('queryPluck','ArticleController@queryPluck');
    Route::get('enabledCount','ArticleController@enabledCount');
    //關聯練習
    Route::get('queryCgyRelation/{cgy}','ArticleController@queryCgyRelation');
    Route::get('changeCgy/{old_cgy_id}/{new_cgy_id}','ArticleController@changeCgy');
    Route::get('getArticleCgy/{article}','ArticleController@');
    Route::get('changeAllCgy/{old_cgy_id}/{new_cgy_id}','ArticleController@changeAllCgy');
    Route::get('queryTags/{article}','ArticleController@queryTags');
    Route::get('addTag/{article}/{tag_id}','ArticleController@addTag');
    Route::get('removeTag/{article}/{tag_id}','ArticleController@removeTag');
    Route::get('syncTag','ArticleController@syncTag');
    Route::get('addTagWithColor/{article}/{tag_id}/{color}','ArticleController@addTagWithColor');
    Route::get('queryTagsWithColor/{article}','ArticleController@queryTagsWithColor');
});

