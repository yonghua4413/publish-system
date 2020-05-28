<?php

Route::middleware([\App\Http\Middleware\CommonMiddleware::class])->group(function (){

    Route::get('/', 'HomeController@index');

    Route::get('/user/reg.html', 'UserController@reg');
    Route::get('/user/forget.html', 'UserController@forget');
    Route::get('/user/login.html', 'UserController@login');

    Route::get('/category/{string}.html', 'CategoryController@showCategory');

    Route::get('/publish/detail/{number}.html', 'PublishController@showDetail');

});

Route::post('/user/doLogin', 'UserController@doLogin');
Route::get('/user/loginOut', 'UserController@loginOut');
Route::post('/user/doReg', 'UserController@doReg');

