<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth; 
use App\Http\Middleware\CustomAuth;
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
    return view('homepage',['title' => 'Новият Транспорт на Варна']);
})->name('homepage');

Route::get('/about', function () {
    return view('about_us',['title' => 'За нас']);
});

Route::get('/scheludes', function () {
    return view('schelude',['title' => 'Разписание']);
});

Route::post('/scheludes/search',"App\Http\Controllers\AjaxController@filterscheludes");

Route::get('/prices', function () {
    return view('prices',['title' => 'Цени']);
});

Route::get('/contact', function () {
    return view('contact',['title' => 'Свържете се с нас']);
});
Route::post('/contact',"App\Http\Controllers\AjaxController@contact");

Route::get('/subscriptions', function () {
    return view('subscription',['title' => 'Нашите абонаментни планове']);
})->middleware(CustomAuth::class);

Route::post('/subscriptions',"App\Http\Controllers\AjaxController@subscriptionActivate");

Route::get('/history', function () {
    return view('history',['title' => 'История на покупките']);
})->middleware(CustomAuth::class);

Route::get('/duties', function () {
    return view('duty',['title' => 'История на задълженията']);
})->middleware(CustomAuth::class);

Route::get('/options', "App\Http\Controllers\OptionsController@create")->middleware(CustomAuth::class);
Route::post('/options', "App\Http\Controllers\OptionsController@update");

Route::get('/qr', function () {
    return view('qr_instructions',['title' => 'QR Инструкции']);
})->middleware(CustomAuth::class);

Route::get('/rules', function () {
    return view('rules',['title' => 'Правила и задължения']);
});
Route::get('/fines', function () {
    return view('fines',['title' => 'Глоби и санкции']);
});

Route::get('/report',"App\Http\Controllers\ReportController@create");
Route::post('/report',"App\Http\Controllers\ReportController@report");


Route::get('/admin-dashboard', function () {
        return view('administrator',['title' => 'Администрация']);
});

Route::get('posts/{post}/', function ($postSlug) {
     return view('post',['title' => 'Публикация','slug' => $postSlug]);
});

Route::get('/blog', function () {
     return view('blog',['title' => 'Блог']);
});

Route::post('/admin-dashboard/delete-penalty',"App\Http\Controllers\AjaxController@deletePenalty");
Route::post('/admin-dashboard/delete-post',"App\Http\Controllers\AjaxController@deletePost");
Route::post('/admin-dashboard',"App\Http\Controllers\AjaxController@addPosts");


Route::post('/admin-dashboard/accept-penalty',"App\Http\Controllers\AjaxController@acceptPenalty");

Route::post('/message/callback',"App\Http\Controllers\MessageController@handleMessage");

Route::get('/encourage', function () {
    return view('encourage',['title' => 'Поощри Служител']);
});

Route::get('/activate/{profile_id}',function($profile_id) {
    return view('activate',['profile_id' => $profile_id]);
});

Route::post('/encourage',"App\Http\Controllers\AjaxController@encourage");

// Route::middleware(['auth:sanctum', 'verified'])->get('/subscriptions', function () {
//     return view('subscription',['title' => 'Нашите абонаментни планове']);
// })->name('subscription');

Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

Route::get('/exit',function(){
     Auth::logout();
     Session::flush();
     return redirect('/');
 });


Route::get('/login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::post('/login',[LoginController::class,'defaultAuthenticate']);

