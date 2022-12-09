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





Route::prefix('/users')->group(function(){
    Route::get('{id?}','App\Http\Controllers\UserController@show');
    Route::get('/','App\Http\Controllers\UserController@show2');
});

//Route::get('/users/{id}','App\Http\Controllers\UserController@show');

Route::get('/posts/{post}/comments/{comment}', function($post,$comment){
    return "posts $post , comments $comment";
});

// Route::get('/game',function(){
//     return view('game1');
// });

// Route::view('/game2','game2');






Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('pics','SiteController@gallery');
    Route::get('game/{id}','SiteController@play');
    Route::get('admin','SiteController@dashboard');
    Route::get('/hello','SiteController@hello');
    Route::get('/demo','SiteController@demo')->name('mydemo');
});

Route::get('paint',function(){
    return view('paint');
})->name('mypaint');

//Route::view('paint','paint');

Route::middleware(['auth'])->group(function(){
    
});

Route::resource('posts','App\Http\Controllers\PostController');
Route::resource('cgies','App\Http\Controllers\CgyController');
Route::resource('articles','App\Http\Controllers\ArticleController');

Route::get('/url',function(){
    //return url('paint');
    //return route('mypaint');
    //return action([SiteController::class,'demo']);
    return url()->current(); 
});

//字串轉陣列
Route::get('/toarray',function(){
    $str = '1,2,3';
    $ary = explode(',',$str);
    dd($ary);
});

//陣列轉字串
Route::get('/tostring',function(){
    $ary = [1,2,3];
    $str = implode(',',$ary);
    dd($str);
});

Route::get('/config',function(){
    dd(config('database.default'));
});

Route::get('/newcgy',function(){
    // $cgy = new Cgy;
    // $cgy->title = '我的英雄學院';
    // $cgy->desc = '我的英雄學院劇場版';
    // $cgy->enabled = true;

    $cgy = new Cgy(['title'=>'我的英雄學院2','desc'=>'我的英雄學院劇場版2','enabled'=>true]);
    $cgy->save();
});

Route::get('/distinct',function(){
    $data = Article::select(['id','subject','cgy_id'])->distinct('cgy_id')->get();
    return $data;
});

Route::get('/pluck',function(){
    //$data = Cgy::select(['id','subject'])->get();
    $data = Cgy::pluck('subject','id');
    return $data;
});
