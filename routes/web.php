<?php

use App\Models\Cgy;
use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/relation',function(){
    $article = Article::find(1);
    dd($article->cgy->subject);
});

Route::get('/changerelation',function(){
    $article = Article::find(1);
    $article->cgy_id = 5;
    // $cgy_4 = Cgy::find(4);
    // $article->cgy()->associate($cgy_4);
    $article->save();
    dd($article);
});



