<?php
use Illuminate\Support\Facades\Route;


Route::GET('/books', 'BookController@index');
Route::POST('/books', 'BookController@store');
Route::PUT('/books/{id}', 'BookController@update');
Route::DELETE('/books/{id}', 'BookController@destroy');