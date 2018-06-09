<?php

Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
Route::get('/posts/{post}', 'PostsController@show');

Route::get('/posts/dashboard/{user_id}', 'PostsController@dashboard');

Route::get('/posts/{id}/edit', 'PostsController@edit');
Route::post('/posts/update/{id}', 'PostsController@update');
Route::delete('/posts/destroy/{id}', 'PostsController@destroy')->name('destroy');

Route::post('/posts/{post}/comments', 'CommentsController@store');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');



