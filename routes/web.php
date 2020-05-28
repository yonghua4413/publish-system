<?php

Route::middleware([\App\Http\Middleware\CommonMiddleware::class])->group(function (){

    Route::get('/', 'HomeController@index');

    Route::get('/user/reg.html', 'UserController@reg');
    Route::get('/user/forget.html', 'UserController@forget');
    Route::get('/user/login.html', 'UserController@login');

    Route::get('/user/set.html', 'UserController@set');
    Route::get('/user/{id}.html', 'UserController@home')->where('id', '[0-9]+');
    Route::get('/category/{spell}.html', 'CategoryController@showCategory')->where('spell', '[A-Za-z]+');
    Route::get('/publish/detail/{id}.html', 'PublishController@showDetail')->where('id', '[0-9]+');

});

Route::post('/user/doLogin', 'UserController@doLogin');
Route::get('/user/loginOut', 'UserController@loginOut');
Route::post('/user/doReg', 'UserController@doReg');
Route::post('/user/rePass', 'UserController@rePass');
Route::post('/user/setHeadImg', 'UserController@setUserHeadImg');

